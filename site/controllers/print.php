<?php
    if(
        isset($_GET['receiptId']) &&
        (int)$_GET['receiptId'] > 0
    ){
        $receiptId = (int)$_GET['receiptId'];
        
        include_once '/models/receipt.php';
        $Receipt = new Receipt($receiptId);
        
        include_once '/helpers/receiptProductHelper.php';
        $receiptProductHelper = new ReceiptProductHelper();
        if(count($Receipt->getReceiptProducts()) > 0){
            foreach ($Receipt->getReceiptProducts() as $receiptProduct){
                $receiptProductHelper->addProduct($receiptProduct['label'], $receiptProduct['priceInVat'], $receiptProduct['amount'], $receiptProduct['totalPriceInVat']);
            }
        }
        $receiptProductHelper->addTotal($Receipt->getPriceInVat());
        $receiptProductHelper->addVAT(6, $Receipt->getPriceExVat(), ($Receipt->getPriceInVat() - $Receipt->getPriceExVat()));
        $receiptProductHelper->output();
    }
    
//    include_once '/models/receipt.php';
//    $receiptProductsTable = '';
//    $receiptTotalPrice = 0;
//    if(isset ($_POST) && count($_POST['products']) > 0){
//        $receiptProductsTable .= '<table>';
//            foreach ($_POST['products'] as $productId => $productAmount) {
//                    $product = new Product($productId);
//                    $receiptProductsTable .= '<tr>';
//                        $receiptProductsTable .= '<td>' . $product->getLabel() . '</td>';
//                        $receiptProductsTable .= '<td>' . $product->getPrice() . '</td>';
//                        $receiptProductsTable .= '<td>' . $productAmount . '</td>';
//                        $productTotalPrice = number_format(($product->getPrice() * $productAmount), 2);
//                        $receiptProductsTable .= '<td>' . $productTotalPrice . '</td>';
//                        $receiptTotalPrice = number_format(($receiptTotalPrice + $productTotalPrice), 2);
//                    $receiptProductsTable .= '</tr>';
//            }
//            $receiptProductsTable .= '<tr><td colspan="4">&nbsp;</td></tr>';
//            
//            $receiptProductsTable .= '<tr>
//                    <td>Totaal</td>
//                    <td colspan="2">&nbsp;</td>
//                    <td>' . $receiptTotalPrice . '</td>
//                </tr>';
//            
//            $receiptProductsTable .= '<tr><td colspan="4">&nbsp;</td></tr>';
//            
//            $receiptProductsTable .= '<tr><td>&nbsp;</td><td>BTW</td><td colspan="2">&nbsp;</td></tr>';
//            
//            $receiptTotalVAT = number_format(($receiptTotalPrice * 0.06), 2);
//            $receiptTotalExVAT = $receiptTotalPrice - $receiptTotalVAT;
//            
//            $receiptProductsTable .= '<tr>
//                    <td>&nbsp;</td>
//                    <td>Schaal</td>
//                    <td>Over</td>
//                    <td>EUR</td>
//                </tr>';
//            
//            $receiptProductsTable .= '<tr>
//                    <td>&nbsp;</td>
//                    <td>6%</td>
//                    <td>' . $receiptTotalExVAT . '</td>
//                    <td>' . $receiptTotalVAT . '</td>
//                </tr>';
//        $receiptProductsTable .= '</table>';
//    }
//    include_once '/views/receipt.php';
    

?>