<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 17/10/15
 * Time: 11:37
 */

class Notifications {
    private $_Ndb,
            $_Ndata;

    public function __construct($Notification = null){
        $this->_Ndb = DB::getInstance();
    }






    public function data(){
        return $this->_Ndata;
    }

    public function getTransactionID(){
        return $this->_Ndata->transactionID;
    }
}
?>