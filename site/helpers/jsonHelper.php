<?php
$response = '';
if(isset ($_GET['f'])){
    include_once 'databaseHelper.php';
    switch ($_GET['f']) {
        case 'getProduct':
            if((int)$_GET['p'] > 0 ){
                include_once '../models/product.php';
                $product = new Product((int)$_GET['p']);
                $response['label'] = $product->getLabel();
                $response['price'] = $product->getPrice();
            }
            break;
    }
}
echo json_encode($response)."\n";
?>