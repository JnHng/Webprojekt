<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 08.11.2016
 * Time: 15:04
 */
echo $_SESSION["loginname"];
include "conn.php";
$sql="SELECT * FROM nutzer "; //Wie bekomme ich den Namen aus der DB? Hab gerade einen Hänger...
$query=$db->query($sql);
$info=$query->fetch(PDO::FETCH_OBJ);

?>
<table width="398" border="0" align="center" cellpadding="0">
    <tr>
        <td height="26" colspan="2">Dein Profil </td>
        <td><div align="right"><a href="login.php">Logout</a></div></td>
        <td><div align="right"><a href="bearbeiten.php">bearbeiten</a></div></td>
    </tr>
    <tr>
        <td width="129" rowspan="5"><img src="upload/<?php $id ?>.png" width="129" height="129"/></td>
        <td width="82" valign="top"><div align="left">Username:</div></td>
        <td width="165" valign="top"><?php echo "$info->username" ?></td>
    </tr>
</table>
<p align="center"><a href="login.php"></a></p>