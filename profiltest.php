<?php
/**
 * Created by PhpStorm.
 * User: Illia
 * Date: 21.12.2016
 * Time: 02:29
 */

session_start();


include "conn.php";

$login = $_SESSION['loginname'];
$datei = $_SESSION['profilbild'];

if(isset($_POST['submit'])) {



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

    if (empty($datei)) {
        echo "W�hlen Sie eine Datei aus";
        exit();
    }

    if($test !== false) {
        $test = getimagesize($tmp_datei);
        echo "Ist ein Bild! - ";

    } else {
        echo "Ist KEIN Bild.";
        exit();

    }

    /* if (file_exists($ordner_datei)) {
        echo "File gibt es schon!";
        exit();
    } */

    /*  if (in_array(exif_imagetype($tmp_datei), array(IMAGETYPE_GIF, IMAGETYPE_GIF, IMAGETYPE_GIF))) {
         echo  "Nur folgende Formate k�nnen akzeptiert werden: JPG, JPEG und PNG.";
     }

    */

    if($dateiform != "jpg" && $dateiform != "png" && $dateiform != "jpeg") {
        echo "Nur folgende Formate k�nnen akzeptiert werden: JPG, JPEG und PNG.";
        exit();
    }


    // $_SESSION['loginname'].jpg;

    if ($size > $max) {
        echo "Zu gro�!";
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
        $up->bindParam(':ordner_datei', $datei, PDO::PARAM_STR);
        $up->bindParam(':login', $login, PDO::PARAM_STR);
        $up->execute();
    } else {
        echo "Fehler!";
    }

 //   $sql = ("SELECT * FROM nutzer WHERE username = :login");
 //$result = $sql->execute(array('username' => $login));
 //$nutzer = $sql->fetch();
    /*   $sql->bindParam(':login', "profilbild", PDO::PARAM_STR);
       $sql->execute(); */

//    $nutzer = $db-> query($sql);
//    while ($row = $nutzer-> fetch(PDO::FETCH_ASSOC)) {
 //       $datei= $row[profilbild];
//        echo $datei."<br />";
        //      if ($row["profilbild"] == "$datei"){
        //      echo "<img width = '100' height = '100' src="/home/iz002/public_html/file/".$row[image].alt='Profilbild'>";
        //     }

    $sql = "SELECT * FROM nutzer WHERE username='$login' AND profilbild='$datei'";
//    echo $sql;
    $query = $db->query($sql);
    if ($query == false) {
        die(var_export($db->errorinfo(), TRUE));
    }


    if ($zeile = $query->fetch(PDO::FETCH_OBJ)) {
        /*  echo "query";*/
        if ($zeile->profilbild == $datei && $zeile->username == $login) {
            $_SESSION["loginname"] = $zeile->username;
            $_SESSION["profilbild"] = $zeile->profilbild;
              echo ("  klappt: $datei  ");
        }


    }

    else {
        echo "Fehler";
    }

    $login = $_SESSION['loginname'];
    $datei = $_SESSION['profilbild'];

    // $sehen = fopen($ordner_datei, "r") or die("File nicht zu �ffnen!");
    // echo fread($sehen, filesize($ordner_datei));
    // fclose($sehen);



}
?>

<table width="398" border="0" align="center" cellpadding="0">
    <tr>
        <td height="26" colspan="2">Dein Profil </td>
        <td><div align="right"><a href="login.php">Logout</a></div></td>
    </tr>
    <tr>
        <td width="129" rowspan="5"><img src="<?php echo $ordner . $datei ?>" width="129" height="129"/></td>
        <td width="82" valign="top"><div align="left">Username:</div></td>
        <td width="165" valign="top"><?php echo "$login" ?></td>
        <td width="82" valign="top"><div align="left">Bildname:</div></td>
        <td width="165" valign="top"><?php echo "$datei" ?></td>
    </tr>
</table>
<p align="center"><a href="login.php"></a></p>



<form action="profiltest.php" method="post" enctype="multipart/form-data">
    <input type="file" name="bilddatei" id="bilddatei"><br>
    <input type="submit" name="submit" value="Hochladen">
</form>