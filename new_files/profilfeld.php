<?php

session_start();

$login = $_SESSION['loginname'];
$datei = $_SESSION['profilbild'];
$ordner = "file/";
$ordner_datei = ($ordner.basename($datei));


?>
<table width="398" border="0" align="center" cellpadding="0">
    <tr>
        <td height="26" colspan="2">Profilfeld </td>
    </tr>

    <td width="129" rowspan="5"><img src="<?php echo $ordner_datei ?>" width="129" height="129"/></td>
    <td width="82" valign="top"><div align="left">Username:</div></td>
    <td width="165" valign="top"><?php echo "$login"  ?></td>
    </tr>
</table>
<p align="center"><a href="../login.php"></a></p>