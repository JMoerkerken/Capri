<?php

if(
    isset($_GET['deleteReceiptId']) &&
    (int)$_GET['deleteReceiptId'] > 0
){
    include_once '/models/receipt.php';
    $Receipt = new Receipt((int)$_GET['deleteReceiptId']);
    $Receipt->delete();
}

include_once '/helpers/adminHelper.php';
$AdminHelper = new AdminHelper();
$receiptOverview  = '';

if(count($AdminHelper->getAllReceiptIdsOrderByDate()) > 0){
    include_once '/models/receipt.php';
    foreach ($AdminHelper->getAllReceiptIdsOrderByDate() as $receiptId){
        $Receipt = new Receipt($receiptId);
        $receiptOverview  .= '<tr>';
        $receiptOverview  .= '<td><a href="index.php?page=print&receiptId='.$Receipt->getId().'" target="_blank" >'. $Receipt->getTimestamp() .'</a></td>';
        $receiptOverview  .= '<td>'. $Receipt->getEmployee() .'</td>';
        $receiptOverview  .= '<td>'. $Receipt->getPriceInVat() .'</td>';
        $receiptOverview  .= '<td>$nbsp;</td>';
        $receiptOverview  .= '<td><a href="index.php?page=admin&deleteReceiptId='.$Receipt->getId().'" >verwijderen</a></td>';
        $receiptOverview  .= '</tr>';
    }
}

include_once '/views/admin.php';
?>