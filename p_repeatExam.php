<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 13/09/15
 * Time: 23:29
 */
/*
     ######    ##     ####    #   #  #####     ##     #   #   ####   #
     #        #  #   #         # #   #    #   #  #     # #   #       #
     #####   #    #   ####      #    #    #  #    #     #     ####   #
     #       ######       #     #    #####   ######     #         #  #
     #       #    #  #    #     #    #       #    #     #    #    #  #
     ######  #    #   ####      #    #       #    #     #     ####   ######
*/

require_once 'core/init.php';
require 'payment/encrypt.php';
require 'Files/accessFile.php';
require_once 'browser/browserconnect.php';

//echo "The 2 digit representation of current month with leading zero is: " . date("m") . '<br />';

$encryptObject = new encrypt();
$tra = new Transaction();
$fileObject = new accessFile();
$dataArray = $fileObject->read('Files/data_repeatExam');
$urlArray = $fileObject->read_newLine('Files/URLs');
$user = new User();

$amount = $dataArray[0];
if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}
$date1 = strtotime($dataArray[1]);
$date2 = time();
$dayLimit = $date1-$date2;
$dayLimit = floor($dayLimit/(60*60*24));

if($dayLimit<0){
    echo "payment is closed!";
}else {
    echo "You have {$dayLimit} days for this payment." . '<br />';
    echo "You have to pay Rs.20.00 to this payment.";
    $prefix = 'easyID_';
    $lastID = (integer)$tra->lastID();
    $newID = $lastID + 1;
    $transactionID = $tra->encodeEasyID($prefix, $newID);
//    $transactionID = $_SESSION['tId'];
//    echo $transactionID . '<br />';

    $merchantCode = 'TESTMERCHANT';
    $transactionAmount = $amount;
    $returnURL = $urlArray[0];
    $Invoice = $encryptObject->encode($merchantCode, $transactionID, $transactionAmount, $returnURL);
    $tra->createTEMP(array(
        'userID' => $user->data()->id
    ));



    //$_SESSION['uID'] = $uID;
    //$_SESSION['reg'] = $uRegID;
    $_SESSION['type'] = 3;

    ?>

    <form action="https://ipg.dialog.lk/ezCashIPGExtranet/servlet_sentinal" method="post">
        <input type="submit" value="Pay via eZcash">
        <input type="hidden" value='<?php echo $Invoice; ?>' name="merchantInvoice">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    </form>
<?
}
?>