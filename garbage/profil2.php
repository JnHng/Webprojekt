<?php
/**
 * Created by PhpStorm.
 * User: Illia
 * Date: 18.12.2016
 * Time: 02:07
 */



session_start();


include "conn.php";
$sql="SELECT * FROM nutzer "; //Wie bekomme ich den Namen aus der DB? Hab gerade einen Hänger...
$query=$db->query($sql);
$info=$query->fetch(PDO::FETCH_OBJ);

$user = $_SESSION['loginname'];
$bild = $_SESSION['profilbild'];
echo $user, $bild;


/* $reg = $db->prepare("SELECT profilbild FROM nutzer WHERE username = :user AND profilbild = :$bild");
$result = $reg->execute(array('username' => $user, 'profilbild' => $bild));
/* $user = $reg->fetchAll();
$anzahl_user = $reg->rowCount();
$nutzer = $reg->fetch(PDO::FETCH_ASSOC); */

$sql = ("SELECT profilbild FROM nutzer");
$resultat = $db-> query($sql);
while ($row = $resultat-> fetch(PDO::FETCH_ASSOC)) {
    echo "$row[profilbild].<br />";
}

echo "$nutzer";

?>
<table width="398" border="0" align="center" cellpadding="0">
    <tr>
        <td height="26" colspan="2">Dein Profil </td>
        <td><div align="right"><a href="../login.php">Logout</a></div></td>
        <td><div align="right"><a href="../bearbeiten2.php">bearbeiten</a></div></td>
    </tr>
    <tr>
        <td width="129" rowspan="5"><img src="$ordner_datei<?php $ordner_datei ?>" width="129" height="129"/></td>
        <td width="82" valign="top"><div align="left">Username:</div></td>
        <td width="165" valign="top"><?php echo "$user" ?></td>
    </tr>
</table>
<p align="center"><a href="../login.php"></a></p>



    <form action="profil2.php" method="post" enctype="multipart/form-data">
        <input type="file" name="bilddatei" id="bilddatei"><br>
        <input type="submit" name="submit" value="Hochladen">
    </form>

<?php

include "conn.php";


if(isset($_POST['submit'])) {

    $login = $_SESSION['loginname'];

    $datei = $_FILES['bilddatei']['name'];
    $tmp_datei = $_FILES['bilddatei']['tmp_name'];
    $typ = $_FILES['bilddatei']['type'];
    $size = $_FILES['bilddatei']['size'];
    $max = 2097152;
    $fehler = $_FILES['bilddatei']['error'];
    $ordner = "/home/iz002/public_html/file/";
    $ordner_datei = ($ordner.basename($datei));
    $dateiname = pathinfo($ordner_datei, PATHINFO_FILENAME);
    $dateiform = pathinfo($ordner_datei, PATHINFO_EXTENSION);

    if (empty($datei)) {
        echo "Wählen Sie eine Datei aus";
        exit();
    }

    if($test !== false) {
        $test = getimagesize($tmp_datei);
        echo "Ist ein Bild! - ";

    } else {
        echo "Ist KEIN Bild.";
        exit();

    }

    if (file_exists($ordner_datei)) {
        echo "File gibt es schon!";
        exit();
    }

    if ($size > $max) {
        echo "Zu groß!";
        exit();
    }


    if (isset($datei)) {

        echo "Ihr Bild: '" . basename($datei) . "' ";

    }

    /* $reg = $db->prepare("SELECT * FROM files LEFT JOIN nutzer ON files.id = nutzer.id");

    $reg->execute(array('id' => 1));
    while($kommentar = $reg->fetch()) {
        echo $kommentar['files.id']." ".$kommentar['nutzer.id']." <br />";

    } */



    if (move_uploaded_file($tmp_datei, $ordner . $datei)) {
        echo 'Coolio: <a href="'.$ordner_datei.'">'.$ordner_datei.'</a>';
        $up = $db->prepare("UPDATE nutzer SET profilbild = :ordner_datei WHERE username = :login");
        $up->bindParam(':ordner_datei', $ordner_datei, PDO::PARAM_STR);
        $up->bindParam(':login', $_SESSION['loginname'], PDO::PARAM_STR);
        $up->execute();
    } else {
        echo "Fehler!";
    }


    // $sehen = fopen($ordner_datei, "r") or die("File nicht zu öffnen!");
    // echo fread($sehen, filesize($ordner_datei));
    // fclose($sehen);



}
?>