<?php
include_once '/models/product.php';
$productModel = new Product();
$productIdGridArray = $productModel->returnProductGridAsArray();
$productGrid = '';

if($productIdGridArray){
    foreach($productIdGridArray as $productRow){
        $productGrid .= '<tr>';
        if(count($productRow)>0){
            foreach($productRow as $productId){
                if($productId > 0){
                    $product = new Product($productId);
                    $productGrid .= '<td onclick="addProductToRegister(\''.$product->getId().'\')"><a class="product">'.$product->getLabel().'</a></td>';
                }else{
                    $productGrid .= '<td></td>';
                }
            }
        }
        $productGrid .= '</tr>';
    }
}

include_once '/views/register.php';
?>