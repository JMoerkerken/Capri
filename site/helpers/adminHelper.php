<?php

class AdminHelper {
    
    private $allReceiptIdsOrderByDate;
    
    function __construct() {
        $this->loadAllReceiptIdsOrderByDate();
    }
    
    private function loadAllReceiptIdsOrderByDate() {
        $databaseHelper = new DatabaseHelper();
        $this->allReceiptIdsOrderByDate = array();
        $receiptIdsDb = $databaseHelper->query("SELECT `id` FROM `receipt` ORDER BY `timestamp` DESC");
        if(count($receiptIdsDb)>0){
            foreach($receiptIdsDb as $receiptIdDb){
                $this->allReceiptIdsOrderByDate[] = $receiptIdDb['id'];
            }
        }
    }
    
    public function getAllReceiptIdsOrderByDate() {
        return $this->allReceiptIdsOrderByDate;
    }

    
}

?>