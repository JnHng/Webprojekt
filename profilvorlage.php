<?php
include "conn.php";
session_start();

$login = $_SESSION['loginname'];
$datei = $_SESSION['profilbild'];

$datei = $_FILES['bilddatei']['name'];
$tmp_datei = $_FILES['bilddatei']['tmp_name'];
$typ = $_FILES['bilddatei']['type'];
$size = $_FILES['bilddatei']['size'];
$max = 2097152;
$fehler = $_FILES['bilddatei']['error'];
$ordner = "file/";
$ordner_datei = ($ordner.basename($datei));
$dateiname = pathinfo($ordner_datei, PATHINFO_FILENAME);
$dateiform = pathinfo($ordner_datei, PATHINFO_EXTENSION);

?>
<table width="398" border="0" align="center" cellpadding="0">
    <tr>
        <td height="26" colspan="2">Dein Profil </td>
        <td><div align="right"><a href="abmelden.php">Logout</a></div></td>
        <td><div align="right"><a href="bearbeiten2.php">Bearbeiten</a></div></td>
        <td><div align="right"><a href="pwchange2.php">Passwort ändern</a></div></td>
    </tr>

        <td width="129" rowspan="5"><img src="<?php echo $ordner . $_SESSION[profilbild] ?>" width="129" height="129"/></td>
        <td width="82" valign="top"><div align="left">Username:</div></td>
        <td width="165" valign="top"><?php echo "$login" ?></td>
        <td width="82" valign="top"><div align="left">Bildname:</div></td>
        <td width="165" valign="top"><?php echo "$_SESSION[profilbild]" ?></td>
    </tr>
</table>

<?php
$strSQL = "SELECT * FROM nutzerfiles WHERE username = '$login'";

// Query ausführen (die Datensatzgruppe $rs enthält das Ergebnis)
$rs = mysql_query($strSQL);

// Schleifendurchlauf durch $rs
// Jede Zeile wird zu einem Array ($row), mit mysql_fetch_array
while($row = mysql_fetch_array($rs)) {

    // Schreibe den Wert der Spalte Vorname (der jetzt im Array $row ist)
    echo $row['name'] . "<br />";

}

// Schließt die Datenbankverbindung
mysql_close();
?>

<p align="center"><a href="login.php"></a></p>
