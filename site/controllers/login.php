<?php
$message='';
if(isset($_POST['login'])){
    if($_POST['login']['name'] != '' && $_POST['login']['pass'] != '') {
        if($_POST['login']['name']=='xavier' && $_POST['login']['pass']=='xavier123'){
            $_SESSION['user'] = 'Xavier Hossen';
        }elseif($_POST['login']['name']=='eric' && $_POST['login']['pass']=='eric123'){
            $_SESSION['user'] = 'Eric Hossen';
        }
    }
    if(isset ($_SESSION['user'])){
        header("Location: index.php");
    }else{
        $message='<b style="color:red;">Verkeerde inloggegevens!!!</b>';
    }
}
include_once '/views/login.php';
?>