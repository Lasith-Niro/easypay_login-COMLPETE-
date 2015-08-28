<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 10/08/15
 * Time: 20:11
 */

class encrypt{
    public function encode($merchantCode, $transactionID, $transactionAmount, $returnURL) {
        $sensitiveData = $merchantCode.'|'.$transactionID.'|'.$transactionAmount.'|'.$returnURL; // query string
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
        $invoice = base64_encode($encrypted); // encoded encrypted query string
        return $invoice;
    }
}
?>