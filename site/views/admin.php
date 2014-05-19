<?php
$GLOBALS['page_view'] .= <<<_END
<h1>Administratie</h1>
<h2>Betalingen overzicht</h2>
<div class="receiptOverview">
    <table cellspacing="10px" cellpadding="0" border="0">
        {$receiptOverview}
    </table>
</div>
_END;
?>