<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro with surangi-edirisinghe
 * Date: 22/08/15
 * Time: 19:50
 */
require_once 'core/init.php';
require 'payment/encrypt.php';
require 'Files/accessFile.php';

$user = new User();
if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
$encryptObject = new encrypt();
$fileObject = new accessFile();
//private function getLastIndex(){
//
//}
$amountArray = $fileObject->read('Files/amount');
//data
$prefix = 'ept_';
$sufix = 1;

$transactionID = 'easy_0121';
$merchantCode = 'TESTMERCHANT';
$transactionAmount = $amountArray[0]; //Rs.10.00 for test payment
$returnURL = 'www.easypaysl.com/ipgResponse.php';
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