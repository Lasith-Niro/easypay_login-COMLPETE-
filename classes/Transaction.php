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
    private $_Tdb,
            $_Tdata;

    public function __construct($Transaction = null){
        $this->_Tdb = DB::getInstance();

    }

    public function create($fields = array()) {
        if(!$this->_Tdb->insert('transaction', $fields)){
            throw new Exception('There was a problem creating an transaction.');
        }
    }

}