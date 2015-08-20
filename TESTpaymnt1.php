<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 10/08/15
 * Time: 19:50
 */

require_once 'core/init.php';


$user = new User();
if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

$transactionID = 'easy_0102';
$merchantCode = 'TESTMERCHANT';
$transactionAmount = '10.00';
$returnURL = 'http://easypay.bitnamiapp.com/payment/ipg.php';
$url = 'https://ipg.dialog.lk/ezCashIPGExtranet/servlet_sentinal';

$sensitiveData = $merchantCode.'|'.$transactionID.'|'.$transactionAmount.'|'.$returnURL;
//echo $sensitiveData;
$publicKey = <<<EOD
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCW8KV72IMdhEuuEks4FXTiLU2o
bIpTNIpqhjgiUhtjW4Si8cKLoT7RThyOvUadsgYWejLg2i0BVz+QC6F7pilEfaVS
L/UgGNeNd/m5o/VoX9+caAIyu/n8gBL5JX6asxhjH3FtvCRkT+AgtTY1Kpjb1Btp
1m3mtqHh6+fsIlpH/wIDAQAB
-----END PUBLIC KEY-----
EOD;
$encrypted = '';
if (!openssl_public_encrypt($sensitiveData, $encrypted, $publicKey))
    die('Failed to encrypt data');
$Invoice = base64_encode($encrypted); // encoded encrypted query string
?>
<form action="https://ipg.dialog.lk/ezCashIPGExtranet/servlet_sentinal" method="post">
    <div class="field">
        <input type="submit" value="Pay via eZcash" name="submit">
        <input type="hidden" value='<?php echo $Invoice; ?>' name="merchantInvoice">
        <input type="hidden" >
    </div>
</form>