<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro with surangi-edirisinghe
 * Date: 10/08/15
 * Time: 19:50
 */
require 'payment/encrypt.php';
require 'Files/accessFile.php';

$user = new User();
if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
$encryptObject = new encrypt();
$fileObject = new accessFile();

$amountArray = $fileObject->read('Files/amount');
//data
$transactionID = 'easy_0111';
$merchantCode = 'TESTMERCHANT';
$transactionAmount = $amountArray[0]; //Rs.10.00 for test payment
$returnURL = 'http://easypay.bitnamiapp.com/payment/ipg.php';
$Invoice = $encryptObject->encode($merchantCode, $transactionID, $transactionAmount, $returnURL);
//echo $Invoice;
?>

<form action="https://ipg.dialog.lk/ezCashIPGExtranet/servlet_sentinal" method="post">
    <div class="field">
        <input type="submit" value="Pay via eZcash" name="submit">
        <input type="hidden" value='<?php echo $Invoice; ?>' name="merchantInvoice">
    </div>
    <!--    <input type="hidden" name="token" value="--><?php //echo Token::generate(); ?><!--">-->
</form>