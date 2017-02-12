
<?php
session_start();
include "ses2.php";
?>

<form action="uploadjoin.php" method="post" enctype="multipart/form-data">
    <input type="file" name="bilddatei" id="bilddatei"><br>
    <input type="submit" name="submit" value="Hochladen">
</form>

<?php
session_start();

include "conn.php";

$login = $_SESSION['loginname'];


echo "Username: $login     " ;

if(isset($_POST['submit'])) {


    $datei = $_FILES['bilddatei']['name'];
    $tmp_datei = $_FILES['bilddatei']['tmp_name'];
    $typ = $_FILES['bilddatei']['type'];
    $size = $_FILES['bilddatei']['size'];
    $max = 1000000;
    $ordner = "file/";
    $ordner_datei = ($ordner . basename($datei));


    $indivdiual = $login.'_';

    $nurname = $indivdiual . $datei;

    $gesamt = $ordner .  $indivdiual . $datei;

    if (empty($datei)) {
        echo "W‰hlen Sie eine Datei aus";
        exit();
    }


    if ($size > $max) {
        echo "Zu groﬂ!";
        exit();
    }
    if (isset($datei)) {
        echo "Ihre Datei: '" . basename($datei) . "' ";
    }




    if (move_uploaded_file($tmp_datei, $ordner . $indivdiual . $datei)) {
        echo 'Coolio: <a href="' . $gesamt . '">' . $gesamt . '</a>';
        $sql = $db->prepare("INSERT INTO files (name, typ, size, username) VALUES(:gesamt,:typ,:size,:login)");
        $sql->bindParam(':gesamt', $nurname, PDO::PARAM_STR);
        $sql->bindParam(':typ', $typ, PDO::PARAM_STR);
        $sql->bindValue(':size', $size, PDO::PARAM_INT);
        $sql->bindValue(':login', $login, PDO::PARAM_STR);
        $sql->execute();

    }

    else {
        echo "Fehler!";
    }


}
?>

