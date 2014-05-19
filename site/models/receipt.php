<?php

/**
 CREATE TABLE IF NOT EXISTS `receipt` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee` varchar(256) DEFAULT NULL,
  `timestamp` TIMESTAMP NOT NULL default CURRENT_TIMESTAMP,
  `priceInVat` float DEFAULT NULL,
  `priceExVat` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
 */

include_once '/models/receiptProduct.php';

class Receipt {
    
    private $id;
    private $employee;
    private $timestamp;
    private $receiptProducts;
    private $priceInVat;
    private $priceExVat;
    
    function __construct($id = 0) {
        if($id > 0){
            $this->id = $id;
            $this->load($id);
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function getEmployee() {
        return $this->employee;
    }

    public function setEmployee($employee) {
        $this->employee = $employee;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }

    public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }

    public function getReceiptProducts() {
        return $this->receiptProducts;
    }

    public function setReceiptProducts($receiptProducts) {
        $this->receiptProducts = $receiptProducts;
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
    
    public function save(){
        $databaseHelper = new DatabaseHelper();
        if((int) $this->id > 0){
            $query = "UPDATE
                `receipt`
            SET  
                `employee` =  '" . $this->employee . "',
                `priceInVat` =  '" . $this->priceInVat . "',
                `priceExVat` =  '" . $this->priceExVat . "'
            WHERE
                `receipt`.`id` =" . (int) $this->id . ";";
            $databaseHelper->query($query);
        }else{
            $query = "INSERT INTO
            `receipt` (
                `employee`,
                `timestamp`,
                `priceInVat`,
                `priceExVat`
            ) VALUES (
                '" . $this->employee . "', 
                CURRENT_TIMESTAMP,
                '" . $this->priceInVat . "',
                '" . $this->priceExVat . "'
            );";
            $databaseHelper->query($query);
            $this->id = $databaseHelper->returnLastInsertId();
        }
        return $this->id;
    }
    
    public function load($id = 0) {
        if((int)$id > 0){
            $this->id = (int)$id;
            $databaseHelper = new DatabaseHelper();
            $receiptDb = $databaseHelper->query("SELECT `employee`, `timestamp`, `priceInVat`, `priceExVat` FROM `receipt` WHERE id = ".$this->id);
            if(count($receiptDb)>0){
                foreach($receiptDb as $receipt){
                    $this->setEmployee($receipt['employee']);
                    $this->setTimestamp($receipt['timestamp']);
                    $this->setPriceInVat($receipt['priceInVat']);
                    $this->setPriceExVat($receipt['priceExVat']);
                }
                $this->loadProducts();
            }
        }
    }
    
    public function delete(){
        if(count($this->receiptProducts) > 0){
            foreach ($this->receiptProducts as $product) {
                $ReceiptProduct = new ReceiptProduct($product['id']);
                $ReceiptProduct->delete();
            }
        }
        if($this->getId() > 0){
            $databaseHelper = new DatabaseHelper();
            $databaseHelper->query("DELETE FROM `receipt` WHERE id = ".$this->getId());
        }
    }
    
    public function addProduct($productId, $label, $priceInVat, $priceExVat, $amount, $totalPriceInVat, $totalPriceExVat){
        if((int) $this->id < 1){
            $this->save();
        }
        $ReceiptProduct = new ReceiptProduct;
        $ReceiptProduct->setReceiptId((int) $this->id);
        $ReceiptProduct->setProductId($productId);
        $ReceiptProduct->setLabel($label);
        $ReceiptProduct->setPriceInVat($priceInVat);
        $ReceiptProduct->setPriceExVat($priceExVat);
        $ReceiptProduct->setAmount($amount);
        $ReceiptProduct->setTotalPriceInVat($totalPriceInVat);
        $ReceiptProduct->setTotalPriceExVat($totalPriceExVat);
        $ReceiptProduct->save();
        
        $this->receiptProducts[] = array(
            'id' => $ReceiptProduct->getId(),
            'productId' => $ReceiptProduct->getProductId(),
            'label' => $ReceiptProduct->getLabel(),
            'priceInVat' => $ReceiptProduct->getPriceInVat(),
            'priceExVat' => $ReceiptProduct->getPriceExVat(),
            'amount' => $ReceiptProduct->getAmount(),
            'totalPriceInVat' => $ReceiptProduct->getTotalPriceInVat(),
            'totalPriceExVat' => $ReceiptProduct->getTotalPriceExVat(),
        );
    }
    
    public function loadProducts(){
            $databaseHelper = new DatabaseHelper();
            $receiptProductsDb = $databaseHelper->query("SELECT `id` FROM `receipt_product` WHERE receiptId = ".$this->id);
            if(count($receiptProductsDb)>0){
                foreach($receiptProductsDb as $receiptProductDb){
                    $ReceiptProduct = new ReceiptProduct($receiptProductDb['id']);
                    $this->receiptProducts[] = array(
                        'id' => $ReceiptProduct->getId(),
                        'productId' => $ReceiptProduct->getProductId(),
                        'label' => $ReceiptProduct->getLabel(),
                        'priceInVat' => $ReceiptProduct->getPriceInVat(),
                        'priceExVat' => $ReceiptProduct->getPriceExVat(),
                        'amount' => $ReceiptProduct->getAmount(),
                        'totalPriceInVat' => $ReceiptProduct->getTotalPriceInVat(),
                        'totalPriceExVat' => $ReceiptProduct->getTotalPriceExVat(),
                    );
                }
            }
    }


}

?>