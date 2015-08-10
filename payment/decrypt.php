<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 10/08/15
 * Time: 20:12
 */
class dycrypt {
    public function __construct() {
        $decrypted = '';
        $encrypted = $_POST[' merchantReciept '];
        $privateKey = <<<EOD
-----BEGIN PRIVATE KEY-----
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAJuIUgSzNuWm3US80brZr/5cMSPue9f0IwUrEhka1gLlC4uQon6QjQem4TWQ8anoMKYwfYgRnCGQsbrTKwOApwTA4Bt6dg9jKXlIE6rXqqO6g2C/uD+G2p+W4k0ZI1isuqqjjkup5ZPkNaeWR9/961Qx3CyrWDk6n0OkzDJ6UNzLAgMBAAECgYEAh+/dv73jfVUaj7l4lZct+2MYkA8grt7yvNGoP8j0xBLsxE7ltzkgClARBoBot9f4rUg0b3j0vWF59ZAbSDRpxJ2UBfWEtlXWvN1V051KnKaOqE8TOkGK0PVWcc6P0JhPrbmOu9hhAN3dMu+jd7ABFKgC4b8EIlHA8bl8po8gwAECQQDliMBTAzzyhB55FMW/pVGq9TBo2oXQsyNOjEO+rZNJzIwJzFrFhvuvFj7/7FekDAKmWgqpuOIk0NSYfHCR54FLAkEArXc7pdPgn386ikOcNn3Eils1WuP5+evoZw01he4NSZ1uXNkoNTAk8OmPJPz3PrtB6l3DUh1U/DEZjIiI7z5igQJAFXvFNH/bFn/TMlYFZDie+jdUvpulZrE9nr52IMSyQngIq2obHN3TdMHKR73hPhN5tAQ9d0E8uWFqZJNRHfbjHQJASY7pNV3Ov/QE0ALxqE3W3VDmJD/OjkOSjriUPNIAwnnHBgp0OXHMCHkSYX4AHpLr1cWjARw9IKB1lBmF7+YFgQJAFqUgYj11ioyuSf/CSotPIC7YyNEnr+TK2Ym0N/EWzqNXoOCDxDTgoWLQxM3Nfr65tWtV2097BjCbFfbui/IyUw==
-----END PRIVATE KEY-----
EOD;
        $encrypted = base64_decode($encrypted); // decode the encrypted query string
        if (!openssl_private_decrypt($encrypted, $decrypted, $privateKey))
            die('Failed to decrypt data');
        echo "Decrypted value: ". $decrypted;
    }
}
?>