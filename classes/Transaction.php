<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 12/08/15
 * Time: 08:38
 */
require 'payment/encrypt.php';
require 'payment/decrypt.php';

class transaction{
    public function makeTransaction($transactionID, $merchantCode, $transactionAmount, $returnURL){
        $encrpt = new encrypt($transactionID, $merchantCode, $transactionAmount, $returnURL);
        return $encrpt;
    }
    public function getTransaction(){
        $decrpt = new decrypt();
        return $decrpt;
    }
//    public function send($url, $data){
//        $sendingString = http_build_query($data);
//        $channel = curl_init($url);
//        curl_setopt($channel, CURLOPT_POST, true);
//        curl_setopt($channel, CURLOPT_POSTFIELDS, $sendingString);
//        curl_setopt($channel, CURLOPT_RETURNTRANSFER, true);
//        curl_exec($channel);
//        curl_close($channel);
//    }
}