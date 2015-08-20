<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 12/08/15
 * Time: 08:38
 */
require 'payment/encrypt.php';
require 'payment/decrypt.php';

class Transaction{

    public function makeTransactionCode($transactionID, $merchantCode, $transactionAmount, $returnURL){
        $encrpt = new encrypt();
        $item = $encrpt->encode($merchantCode, $transactionID, $transactionAmount, $returnURL);
        return $item;
    }

    public function getTransaction(){
        $decrpt = new decrypt();
        return $decrpt;
    }

    public function getData($URL){
////        $url = "someplace.com/products.php?page=12";
////        $parts = parse_url($url);
////        $output = [];
////        parse_str($parts['query'], $output);
////        echo $query['page'];
//        print $_SESSION['data'];

        //Open a stream in READ mode
        $handle = fopen ($URL, "r");

//Read the content of the URL and manipulate it.
        $key = str_replace(' ', '%20',fread($handle, 1000000));
        print $key;
    }
}