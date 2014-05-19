<?php
    include_once 'helpers/databaseHelper.php';
    include_once 'helpers/sessionHelper.php';
    include_once 'helpers/pageHelper.php';
    include_once 'controllers/'. $GLOBALS['_PAGE'] .'.php';
    
$output = <<<_END
<html>
    <head>
        <meta name="viewport" content="width=640" />
        <link rel="stylesheet" type="text/css" href="style/default.css">
        <script type="text/javascript" src="js/jquery.js" ></script>
        <script type="text/javascript" src="js/register.js" ></script>
    </head>
    <body>
        <ul id="mainNavigation">
            <li><a href="index.php?page=register" >Kassa</a></li>
            <li><a href="index.php?page=admin" >Admin</a></li>
            <li><a href="index.php?page=logout" >Uitloggen</a></li>
        </ul>
        {$GLOBALS['page_view']}
    </body>
</html>
_END;
echo $output;