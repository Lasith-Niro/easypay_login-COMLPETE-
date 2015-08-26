<?php
//require_once 'core/init.php';
//require 'payment/encrypt.php';
//require 'Files/accessFile.php';
//
//$user = new User();
//if(!$user->isLoggedIn()){
//    Redirect::to('index.php');
//}
//$encryptObject = new encrypt();
//$fileObject = new accessFile();
//
//$amountArray = $fileObject->read('Files/amount');
////data
//$transactionID = 'easy_0111';
//$merchantCode = 'TESTMERCHANT';
//$transactionAmount = $amountArray[0]; //Rs.10.00 for test payment
//$returnURL = 'http://easypay.bitnamiapp.com/payment/ipgResponse.php';
//$Invoice = $encryptObject->encode($merchantCode, $transactionID, $transactionAmount, $returnURL);
////echo $Invoice;
//?>
<!--<form action="https://ipg.dialog.lk/ezCashIPGExtranet/servlet_sentinal" method="post">-->
<!--    <div class="field">-->
<!--        <input type="submit" value="Pay via eZcash" name="submit">-->
<!--        <input type="hidden" value='--><?php //echo $Invoice; ?><!--' name="merchantInvoice">-->
<!--    </div>-->
<!--</form>-->
<!---->

<?php
//echo sha1(md5(time()));
$pre = 'epTID';
$suf = 1;
//$str = $pre . (string)$suf;
//echo str_pad($input, 10);                      // produces "Alien     "

//echo str_pad($pre, 8, "0" ,STR_PAD_LEFT);  // produces "-=-=-Alien"
//echo str_pad($input, 10, "_", STR_PAD_BOTH);   // produces "__Alien___"
echo str_pad($pre, 6 , $suf);               // produces "Alien_"
?>
