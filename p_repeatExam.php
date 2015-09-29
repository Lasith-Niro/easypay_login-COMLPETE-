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
$amountArray = $fileObject->read('Files/amount');
$user = new User();

if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

$prefix = 'easyID_';
$lastID = (integer)$tra->lastID();
$newID = $lastID + 1;
$transactionID = $tra->encodeEasyID($prefix, $newID);

echo "You have to pay Rs.20.00 to this payment.";

$transactionID = $_SESSION['tId'];
echo $transactionID . '<br />';


$merchantCode = 'TESTMERCHANT';
$transactionAmount = $amountArray[0];
$returnURL = 'www.easypaysl.com/ipgResponse.php';
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