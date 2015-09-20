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

$encryptObject = new encrypt();
$tra = new Transaction();
$fileObject = new accessFile();
$amountArray = $fileObject->read('Files/amount');
$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

$prefix = 'easyID_';
$lastID = (integer)$tra->lastID();
$newID = $lastID + 1;
$transactionID = $tra->easyID($prefix, $newID);
echo $transactionID;
//$merchantCode = 'TESTMERCHANT';
//$transactionAmount = $amountArray[0];
//$returnURL = 'www.easypaysl.com/ipgResponse.php';
//$Invoice = $encryptObject->encode($merchantCode, $transactionID, $transactionAmount, $returnURL);
//$tra->createTEMP(array(
//    'userID' => $user->data()->id
//));

$date1 = strtotime('2015-08-19');
$date2 = time();
$dayLimit = $date2-$date1;
$dayLimit = floor($dayLimit/(60*60*24));
echo "You have {$dayLimit} days for this payment." . '<br />';

$uID = $user->data()->id;
$uRegID = $user->data()->regNumber;
if(!$uRegID){
    echo "You have not submitted your registration number." . '<br />';
} else {
    echo "Your registration number is " . $uRegID . '<br />';
}
echo "You have to pay Rs.600 for register." . '<br />';

$_SESSION['uID'] = $uID;
$_SESSION['reg'] = $uRegID;
$_SESSION['type'] = 2;

?>


<form action="https://ipg.dialog.lk/ezCashIPGExtranet/servlet_sentinal" method="post">

    <input type="submit" value="Pay via eZcash">
    <input type="hidden" value='<?php echo $Invoice; ?>' name="merchantInvoice">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>