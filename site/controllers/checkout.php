<?php
    include_once '/models/product.php';
    include_once '/models/receipt.php';
    $checkoutProductsTable = '';
    $checkoutTotalPrice = 0;
    $receiptId = 0;
    if(isset ($_POST) && count($_POST['products']) > 0){
        $Receipt = new Receipt();
        $checkoutProductsTable .= '<table>';
            foreach ($_POST['products'] as $productId => $productAmount) {
                    $product = new Product($productId);
                    $productPriceExVat = number_format(($product->getPrice() * 0.06), 2);
                    $productTotalPrice = number_format(($product->getPrice() * $productAmount), 2);
                    $productTotalPriceExVat = number_format(($productTotalPrice * 0.06), 2);
                    $checkoutTotalPrice = number_format(($checkoutTotalPrice + $productTotalPrice), 2);
                        
                    $Receipt->addProduct($productId, $product->getLabel(), $product->getPrice(), $productPriceExVat, $productAmount, $productTotalPrice, $productTotalPriceExVat);
                    
                    $checkoutProductsTable .= '<tr>';
                        $checkoutProductsTable .= '<td>' . $product->getLabel() . '</td>';
                        $checkoutProductsTable .= '<td>' . $product->getPrice() . '</td>';
                        $checkoutProductsTable .= '<td>' . $productAmount . '</td>';
                        $checkoutProductsTable .= '<td>' . $productTotalPrice . '</td>';
                    $checkoutProductsTable .= '</tr>';
            }
            $checkoutProductsTable .= '<tr><td colspan="4">&nbsp;</td></tr>';
            
            $checkoutProductsTable .= '<tr>
                    <td>Totaal</td>
                    <td colspan="2">&nbsp;</td>
                    <td>' . $checkoutTotalPrice . '</td>
                </tr>';
            
            $checkoutProductsTable .= '<tr><td colspan="4">&nbsp;</td></tr>';
            
            $checkoutProductsTable .= '<tr><td>&nbsp;</td><td>BTW</td><td colspan="2">&nbsp;</td></tr>';
            
            $checkoutTotalVAT = number_format(($checkoutTotalPrice * 0.06), 2);
            $checkoutTotalExVAT = $checkoutTotalPrice - $checkoutTotalVAT;
            
            $checkoutProductsTable .= '<tr>
                    <td>&nbsp;</td>
                    <td>Schaal</td>
                    <td>Over</td>
                    <td>EUR</td>
                </tr>';
            
            $checkoutProductsTable .= '<tr>
                    <td>&nbsp;</td>
                    <td>6%</td>
                    <td>' . $checkoutTotalExVAT . '</td>
                    <td>' . $checkoutTotalVAT . '</td>
                </tr>';
        $checkoutProductsTable .= '</table>';
        $Receipt->setEmployee($GLOBALS['_USER']);
        $Receipt->setPriceInVat($checkoutTotalPrice);
        $Receipt->setPriceExVat($checkoutTotalExVAT);
        $Receipt->save();
        $receiptId = $Receipt->getId();
    }
    include_once '/views/checkout.php';
?>