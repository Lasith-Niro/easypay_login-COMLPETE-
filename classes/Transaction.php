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

//    public $id;

    public function __construct($Transaction = null){
        $this->_Tdb = DB::getInstance();

    }

    public function createNewAcademicYear($fields = array()) {
        if(!$this->_Tdb->insert('New_Academic_Year', $fields)){
            throw new Exception('There was a problem creating an data.');
        }
    }

    public function createUCSCRegistration($fields = array()) {
        if(!$this->_Tdb->insert('UCSC_Registration', $fields)){
            throw new Exception('There was a problem creating an transaction.');
        }
    }

    public function create($fields = array()) {
        if(!$this->_Tdb->insert('transaction', $fields)){
            throw new Exception('There was a problem creating an transaction.');
        }
    }

    public function createTEMP($fields = array()) {
        if(!$this->_Tdb->insert('transaction_TEMP', $fields)){
            throw new Exception('There was a problem creating an transaction.');
        }
    }

    public function updateStatus($tblName,$fields = array(), $transactioID=null){
        if(!$this->_Tdb->update($tblName, $transactioID, $fields)) {
            throw new Exception('There was a problem updating..');
        }
    }

    public function data(){
        return $this->_Tdata;
    }

    public function getTransactionID(){
        return $this->_Tdata->transactionID;
    }

    public function lastID(){
        $data = $this->_Tdb->getLast('transaction_TEMP', 'ss');
        return $data->count();
    }

    public function encodeEasyID($pre, $str){
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

    public function decodeEasyID($str){
        $zeros = substr_count($str, '0');
        $id = '';

    }
    /* try
    public function getLastID(){
        $data = $this->_Tdb->returnLast('transaction', 'transactionID', 'transactionID', 'ss' );
        return $data;
    }
    */
}