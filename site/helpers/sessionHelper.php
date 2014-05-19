<?php
session_start();
//check if user is not logged in
if(!isset ($_SESSION['user'])){
    //login);
    $GLOBALS['_PAGE'] = 'login';
}else{
//    set user in GLOBAL
    $GLOBALS['_USER'] = $_SESSION['user'];
}
?>