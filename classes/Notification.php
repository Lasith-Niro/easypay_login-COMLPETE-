<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 17/10/15
 * Time: 11:37
 */

class Notification {
    private $_Ndb,
            $_Ndata;

    public function __construct($Notification = null){
        $this->_Ndb = DB::getInstance();
    }

    public function createNotification($fields = array()) {
        if(!$this->_Ndb->insert('notification', $fields)){
            throw new Exception('There was a problem in connection');
        }
    }

    public function deleteNotification($txt){
        if(!$this->_Ndb->delete('notification', array('nID', '=', $txt))){
            throw new Exception('There was a problem in connection');
        }
    }

    public function data(){
        return $this->_Ndata;
    }

    public function getTransactionID(){
        return $this->_Ndata->nID;
    }
}
?>