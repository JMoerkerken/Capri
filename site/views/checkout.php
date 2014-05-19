<?php
$GLOBALS['page_view'] .= <<<_END
<h1>Afrekenen</h1>
<div class="checkoutProducts">
    {$checkoutProductsTable}
</div>
<ul>
    <li><a href="index.php?page=print&receiptId={$receiptId}" target="_blank" >Print</a></li>
    <li><a href="index.php?page=register" >Verder</a></li>
</ul>
_END;
?>