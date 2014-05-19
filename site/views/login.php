<?php
$loginName = (isset($_POST['login']['name'])?$_POST['login']['name']:'');
$loginPass = (isset($_POST['login']['pass'])?$_POST['login']['pass']:'');
$GLOBALS['page_view'] .= <<<_END
<form action="" method="POST">
    <table>
        <tr>
            <th colspan="2">Login</th>
        </tr>
        <tr>
            <td colspan="2"><?php echo $message; ?></td>
        </tr>
        <tr >
            <td><label for="name">Naam</label></td>
            <td><input id="name" value="{$loginName}" name="login[name]" /></td>
        </tr>
        <tr >
            <td><label for="pass">WW</label></td>
            <td><input type="password" id="pass" value="{$loginPass}" name="login[pass]" /></td>
        </tr>
        <tr >
            <td></td>
            <td><input type="submit" name="submit" value="Inloggen"></td>
        </tr>
    </table>
</form>
_END;
?>