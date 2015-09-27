<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 13/09/15
 * Time: 23:28
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
if($user->data()->year == 1){

    $prefix = 'easyID_';
    $lastID = (integer)$tra->lastID();
    $newID = $lastID + 1;
    $transactionID = $tra->encodeEasyID($prefix, $newID);
//    $transactionID = 1;
    //$merchantCode = 'TESTMERCHANT';
    //$transactionAmount = $amountArray[0];
    //$returnURL = 'www.easypaysl.com/ipgResponse.php';
    //$Invoice = $encryptObject->encode($merchantCode, $transactionID, $transactionAmount, $returnURL);
    //$tra->createTEMP(array(
    //    'userID' => $user->data()->id
    //));
    $uNIC = $user->data()->nic;
    $regYear = date("Y") + 1;
    $_SESSION['type'] = 1;

    echo "Your registration number is " . $uNIC . '<br />';
    $uRegID = $user->data()->regNumber;
    if(!$uRegID){
        echo "You have not submitted your registration number." . '<br />';
    } else {
        echo "Your registration number is " . $uRegID . '<br />';
    }
    echo "You pay for {$regYear}." . '<br />';
    echo "You have to pay Rs.2500 for register." . '<br />';
    //
    //$_SESSION['nic'] = $uNIC;
    //$_SESSION['reg'] = $uRegID;



    $tra->createUCSCRegistration(array(
        'transactionID' => $transactionID,
        'regYear' => $regYear,
        'status' => 0
    ))

?>


<form action="https://ipg.dialog.lk/ezCashIPGExtranet/servlet_sentinal" method="post">
    <input type="submit" value="Pay via eZcash">
    <input type="hidden" value='<?php echo $Invoice; ?>' name="merchantInvoice">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>

<?php
} else {
    echo "You cannot make this payment.";
}

?>