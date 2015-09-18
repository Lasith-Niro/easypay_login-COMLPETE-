<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 12/08/15
 * Time: 08:38
 */

class Transaction{
    private $_Tdb,
            $_Tdata;

    public $id;

    public function __construct($Transaction = null){
        $this->_Tdb = DB::getInstance();

    }

    public function create($fields = array()) {
        if(!$this->_Tdb->insert('transaction', $fields)){
            throw new Exception('There was a problem creating an transaction.');
        }
    }

    public function data(){
        return $this->_Tdata;
    }

    public function getTransactionID(){
        return $this->_Tdata->transactionID;
    }

    public function lastID(){
        $data = $this->_Tdb->getLast('transaction', 'ss');
        return $data->count();
    }

    public function easyID($pre, $str){
        $num = strlen((string)$str);
        $item = '';
        switch($num){
            case 1:
                $item = '000';
                break;
            case 2:
                $item = '00';
                break;
            case 3:
                $item = '0';
                break;
            case 4:
                $item = '';
                break;
        }
        return $pre . $item . $str;
    }
    /* try
    public function getLastID(){
        $data = $this->_Tdb->returnLast('transaction', 'transactionID', 'transactionID', 'ss' );
        return $data;
    }
    */
}