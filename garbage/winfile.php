<form action="winfile.php?submit=1" method="post" enctype="multipart/form-data">
    <input type="file" name="bilddatei" id="bilddatei"><br>
    <input type="submit" name="submit" value="Hochladen">
</form>

<?php
session_start();

include "conn.php";

if(isset($_POST['submit'])) {

    $login = $_SESSION['loginname'];

    $datei = $_FILES['bilddatei']['name'];
    $tmp_datei = $_FILES['bilddatei']['tmp_name'];
    $typ = $_FILES['bilddatei']['type'];
    $size = $_FILES['bilddatei']['size'];
    $max = 2097152;
    $fehler = $_FILES['bilddatei']['error'];
    $ordner = "uploads/";
    $ordner_datei = ($ordner . basename($datei));
    $ordnerd = ($ordner . $datei);
    $dateiname = pathinfo($ordner_datei, PATHINFO_FILENAME);
    $dateiform = pathinfo($ordner_datei, PATHINFO_EXTENSION);
    if (empty($datei)) {
        echo "W�hlen Sie eine Datei aus";
        exit();
    }

    if($test !== false) {
           $test = getimagesize($tmp_datei);
           echo "Ist ein Bild! ";
       } else {
           echo "Ist KEIN Bild.";
           exit();
       }

    if (file_exists($ordner_datei)) {
        echo "File gibt es schon!";
        exit();
    }
    if ($size > $max) {
        echo "Zu gro�!";
        exit();
    }
    if (isset($datei)) {
        echo "Ihr Bild: '" . basename($datei) . "' ";
    }
    if (move_uploaded_file($tmp_datei, $ordner_datei)) {
        echo 'Coolio: <a href="'.$ordner_datei.'">'.$ordner_datei.'</a>';
        $up = $db->prepare("INSERT INTO files (name, typ, size) VALUES(:ordner_datei,:typ,:size)");
        $up->bindParam(':ordner_datei', $ordner_datei, PDO::PARAM_STR);
        $up->bindParam(':typ', $typ, PDO::PARAM_STR);
        $up->bindValue(':size', $size, PDO::PARAM_INT);
        $up->execute();
    } else {
        echo "Fehler!";
    }


$zitate = file_get_contents('$ordner_datei');
echo $zitate;


    /* $sehen = fopen($ordner_datei, "r") or die("File nicht zu �ffnen!");
    echo fread($sehen, filesize($ordner_datei));
    fclose($sehen); */
}
?>
