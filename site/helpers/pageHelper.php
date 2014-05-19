<?php
//Set empty text
$GLOBALS['page_view'] = '';
if(!isset($GLOBALS['_PAGE'])){
    //check if page get isset
    if(isset ($_GET['page']) && $_GET['page']!=''){
        //set Page
        $GLOBALS['_PAGE'] = $_GET['page'];
    }else{
        //set default page
        $GLOBALS['_PAGE'] = 'welcome';
    }
}
?>