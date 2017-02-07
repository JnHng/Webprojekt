<form action="uploadjoin.php" method="post" enctype="multipart/form-data">
    <input type="file" name="bilddatei" id="bilddatei"><br>
    <input type="submit" name="submit" value="Hochladen">
</form>

<?php
session_start();

include "conn.php";

$login = $_SESSION['loginname'];
// $filename = $_SESSION['filename'];

echo "Username: $login     " ;

if(isset($_POST['submit'])) {

    $login = $_SESSION['loginname'];
   // $filename = $_SESSION['filename'];

    $datei = $_FILES['bilddatei']['name'];
    $tmp_datei = $_FILES['bilddatei']['tmp_name'];
    $typ = $_FILES['bilddatei']['type'];
    $size = $_FILES['bilddatei']['size'];
    $max = 2000000;
    $fehler = $_FILES['bilddatei']['error'];
    $ordner = "file/";
    $ordner_datei = ($ordner . basename($datei));
    $ordnerd = ($ordner . $datei);
    $dateiform = pathinfo($ordner_datei, PATHINFO_EXTENSION);

    $indivdiual = $login.'_';

    $nurname = $indivdiual . $datei;

    $gesamt = $ordner .  $indivdiual . $datei;


    if (empty($datei)) {
        echo "Wählen Sie eine Datei aus";
        exit();
    }

    /* if($test !== false) {
           $test = getimagesize($tmp_datei);
           echo "Ist ein Bild! ";
       } else {
           echo "Ist KEIN Bild.";
           exit();
       } */

//    if (file_exists($ordner_datei)) {
//       echo "File gibt es schon!";
//        exit();
//    }

    if ($size > $max) {
        echo "Zu groß!";
        exit();
    }
    if (isset($datei)) {
        echo "Ihre Datei: '" . basename($datei) . "' ";
    }


     $sql = "SELECT nutzer.username, files.name
     FROM nutzer
     RIGHT JOIN files
     ON nutzer.username = files.username
     ORDER BY files.name";
     /*  foreach ($db->query($sql) as $row) {
             echo "<br /> $row[name].<br />";
         } */



    if (move_uploaded_file($tmp_datei, $ordner . $indivdiual . $datei)) {
            echo 'Coolio: <a href="' . $gesamt . '">' . $gesamt . '</a>';
            $sql = $db->prepare("INSERT INTO files (name, typ, size, username) VALUES(:gesamt,:typ,:size,:login)");
            $sql->bindParam(':gesamt', $nurname, PDO::PARAM_STR);
            $sql->bindParam(':typ', $typ, PDO::PARAM_STR);
            $sql->bindValue(':size', $size, PDO::PARAM_INT);
            $sql->bindValue(':login', $login, PDO::PARAM_STR);
            $sql->execute();

        $sql = $db->prepare("INSERT INTO nutzerfiles (username, name) VALUES(:login, :ordner_datei)");
        $sql->bindValue(':login', $login, PDO::PARAM_STR);
        $sql->bindParam(':ordner_datei', $ordner_datei, PDO::PARAM_STR);
        $sql->execute();

        }

        else {
            echo "Fehler!";
        }









//$zitate = file_get_contents('$ordner_datei');
//echo $zitate;


    /* $sehen = fopen($ordner_datei, "r") or die("File nicht zu öffnen!");
    echo fread($sehen, filesize($ordner_datei));
    fclose($sehen); */
}
?>
