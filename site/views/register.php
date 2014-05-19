<?php
$GLOBALS['page_view'] .= <<<_END
<h1>Kassa</h1>
<div class="registerDisplay">
    <div id="receiptTotal">&euro;0.00</div>
    <div id="receiptProducts"></div>
    <form id="receiptForm" name="receiptForm" action="index.php?page=checkout" method="POST"></form>
</div>
<div class="registerProductGrid">
    <table cellspacing="0" cellpadding="0" border="1">
        {$productGrid}
    </table>
</div>
_END;
?>