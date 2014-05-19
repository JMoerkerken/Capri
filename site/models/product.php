<?php

/**
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(256) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `regRow` int(11) unsigned DEFAULT NULL,
  `regCol` int(11) unsigned DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
 */

class Product {
    
    private $id;
    private $label;
    private $price;
    private $regRow;
    private $regCol;
    private $visible;
    
    function __construct($id = 0) {
        if($id > 0){
            $this->id = $id;
            $this->load($id);
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getLabel() {
        return $this->label;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getRegRow() {
        return $this->regRow;
    }

    public function setRegRow($regRow) {
        $this->regRow = $regRow;
    }

    public function getRegCol() {
        return $this->regCol;
    }

    public function setRegCol($regCol) {
        $this->regCol = $regCol;
    }

    public function getVisible() {
        return $this->visible;
    }

    public function setVisible($visible) {
        $this->visible = $visible;
    }
    
    public function save(){
        
    }
    
    public function load($id = 0) {
        if($id > 0){
            $this->id = $id;
            $databaseHelper = new DatabaseHelper();
            $productDb = $databaseHelper->query("SELECT label, price, visible FROM `product` WHERE id = ".$id);
            if(count($productDb)>0){
                foreach($productDb as $product){
                    $this->setLabel($product['label']);
                    $this->setPrice($product['price']);
                    $this->setVisible($product['visible']);
                }
            }
        }
    }
    
    public function delete(){
        
    }
    
    public function returnProductGridAsArray(){
        $gridArray = array();
        $databaseHelper = new DatabaseHelper();
        
        //create basic array
        $maxGridSize = $databaseHelper->query("SELECT MAX( regRow ) AS maxrow, MAX( regCol ) AS maxcol FROM `product` ");
        if((int)$maxGridSize[0]['maxrow']>0 && (int)$maxGridSize[0]['maxcol']>0){
            for($r = 1; $r <= (int)$maxGridSize[0]['maxrow']; $r++){
                for($c = 1; $c <= (int)$maxGridSize[0]['maxcol']; $c++){
                        $gridArray[$r][$c]=0;
                }
            }
        }
        
        //fill basic array with products
        $allProducts = $databaseHelper->query("SELECT id, regRow, regCol FROM `product` ORDER BY regRow, regCol");
        if(count($allProducts)>0){
            foreach($allProducts as $product){
                $gridArray[$product['regRow']][$product['regCol']]=$product['id'];
            }
        }
        
        return $gridArray;
    }
    
}

?>