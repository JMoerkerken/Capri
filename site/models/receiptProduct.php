<?php

/**
CREATE TABLE IF NOT EXISTS `receipt_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `receiptId` int(11) unsigned,
  `productId` int(11) unsigned,
  `label` varchar(256) DEFAULT NULL,
  `priceInVat` float DEFAULT NULL,
  `priceExVat` float DEFAULT NULL,
  `amount` int(11) unsigned,
  `totalPriceInVat` float DEFAULT NULL,
  `totalPriceExVat` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
 */

class ReceiptProduct {
    
    private $id;
    private $receiptId;
    private $productId;
    private $label;
    private $priceInVat;
    private $priceExVat;
    private $amount;
    private $totalPriceInVat;
    private $totalPriceExVat;
    
    function __construct($id = 0) {
        if($id > 0){
            $this->id = (int)$id;
            $this->load($this->id);
        }
    }
    
    public function getId() {
        return (int)$this->id;
    }

    public function getReceiptId() {
        return $this->receiptId;
    }

    public function setReceiptId($receiptId) {
        $this->receiptId = $receiptId;
    }
    
    public function getProductId() {
        return $this->productId;
    }

    public function setProductId($productId) {
        $this->productId = $productId;
    }

    public function getLabel() {
        return $this->label;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function getPriceInVat() {
        return $this->priceInVat;
    }

    public function setPriceInVat($priceInVat) {
        $this->priceInVat = $priceInVat;
    }

    public function getPriceExVat() {
        return $this->priceExVat;
    }

    public function setPriceExVat($priceExVat) {
        $this->priceExVat = $priceExVat;
    }
    
    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getTotalPriceInVat() {
        return $this->totalPriceInVat;
    }

    public function setTotalPriceInVat($totalPriceInVat) {
        $this->totalPriceInVat = $totalPriceInVat;
    }

    public function getTotalPriceExVat() {
        return $this->totalPriceExVat;
    }

    public function setTotalPriceExVat($totalPriceExVat) {
        $this->totalPriceExVat = $totalPriceExVat;
    }
    
    public function save(){
        $databaseHelper = new DatabaseHelper();
        if($this->getId() > 0){
            $query = "
                UPDATE 
                    `receipt_product`
                SET
                    `productId` =  '" . $this->getProductId() . "',
                    `receiptId` =  '" . $this->getReceiptId() . "',
                    `label` =  '" . $this->getLabel() . "',
                    `priceInVat` =  '" . $this->getPriceInVat() . "',
                    `priceExVat` =  '" . $this->getPriceExVat() . "',
                    `amount` =  '" . $this->getAmount() . "',
                    `totalPriceInVat` =  '" . $this->getTotalPriceInVat() . "',
                    `totalPriceExVat` =  '" . $this->getTotalPriceExVat() . "' 
                WHERE  
                    `receipt_product`.`id` =" . $this->getId() . ";
                ";
        }else{
            $query = "
                INSERT INTO 
                `receipt_product` (
                    `productId` ,
                    `receiptId` ,
                    `label` ,
                    `priceInVat` ,
                    `priceExVat` ,
                    `amount` ,
                    `totalPriceInVat` ,
                    `totalPriceExVat`
                ) VALUES (
                    '" . $this->getProductId() . "',
                    '" . $this->getReceiptId() . "',
                    '" . $this->getLabel() . "',
                    '" . $this->getPriceInVat() . "',
                    '" . $this->getPriceExVat() . "',
                    '" . $this->getAmount() . "',
                    '" . $this->getTotalPriceInVat() . "',
                    '" . $this->getTotalPriceExVat() . "'
                );                
            ";
        }
        $databaseHelper->query($query);
        $this->id = $databaseHelper->returnLastInsertId();
        return $this->id;
    }
    
    public function load($id = 0) {
        if((int)$id > 0){
            $this->id = (int)$id;
            $databaseHelper = new DatabaseHelper();
            $receiptProductDb = $databaseHelper->query("SELECT `productId` , `receiptId` , `label` , `priceInVat` , `priceExVat` , `amount` , `totalPriceInVat` , `totalPriceExVat` FROM `receipt_product` WHERE id = ".$this->id);
            if(count($receiptProductDb)>0){
                foreach($receiptProductDb as $receiptProduct){
                    $this->setProductId($receiptProduct['productId']);
                    $this->setReceiptId($receiptProduct['receiptId']);
                    $this->setLabel($receiptProduct['label']);
                    $this->setPriceInVat($receiptProduct['priceInVat']);
                    $this->setPriceExVat($receiptProduct['priceExVat']);
                    $this->setAmount($receiptProduct['amount']);
                    $this->setTotalPriceInVat($receiptProduct['totalPriceInVat']);
                    $this->setTotalPriceExVat($receiptProduct['totalPriceExVat']);
                }
            }
        }
    }
    
    public function delete(){
        if($this->getId() > 0){
            $databaseHelper = new DatabaseHelper();
            $databaseHelper->query("DELETE FROM `receipt_product` WHERE id = ".$this->getId());
        }
    }


}

?>