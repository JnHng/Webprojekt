<?php
$site_title = "Datei hochladen";
include "header.php";
include "navigation.php";
?>

<div class="text-center" class="row">
    <div class="container">
        <div class="col-md-12">
            <h3>Upload your files here!</h3>

<form action="uploadjoin.php" method="post" enctype="multipart/form-data">
    <input style="margin-left: auto; margin-right: auto; padding-top: 10px;" type="file" name="bilddatei" id="bilddatei"><br>
    <input class="text-center" type="submit" name="submit" value="Hochladen">
</form>

<div style="padding-top: 20px;">

<?php

$login = $_SESSION['loginname'];

if(isset($_POST['submit'])) {


    $datei = $_FILES['bilddatei']['name'];
    $tmp_datei = $_FILES['bilddatei']['tmp_name'];
    $typ = $_FILES['bilddatei']['type'];
    $size = $_FILES['bilddatei']['size'];
    $max = 1000000;
    $ordner = "uploads/";
    $ordner_datei = ($ordner . basename($datei));


    $indivdiual = $login.'_';

    $nurname = $indivdiual . $datei;

    $gesamt = $ordner .  $indivdiual . $datei;

    if (empty($datei)) {
        echo "Wählen Sie eine Datei aus.";
        exit();
    }


    if ($size > $max) {
        echo "Ihre Datei ist zu groß!";
        exit();
    }

    $wiederholung = $db->prepare("SELECT name FROM files WHERE name = :gesamt");
    $wiederholung->bindParam(':gesamt', $gesamt, PDO::PARAM_STR);
    $wiederholung->execute();
    $alt = $wiederholung->fetch(PDO::FETCH_ASSOC);

    if($alt == true) {
        echo 'Sie haben bereits eine Datei mit diesem Namen. Ändern Sie den Dateinamen!';
        exit();
    }


    if (move_uploaded_file($tmp_datei, $ordner . $indivdiual . $datei)) {
        $sql = $db->prepare("INSERT INTO files (name, typ, size, username) VALUES(:gesamt,:typ,:size,:login)");
        $sql->bindParam(':gesamt', $gesamt, PDO::PARAM_STR);
        $sql->bindParam(':typ', $typ, PDO::PARAM_STR);
        $sql->bindValue(':size', $size, PDO::PARAM_INT);
        $sql->bindValue(':login', $login, PDO::PARAM_STR);
        $sql->execute();

        echo "Ihre Datei " . basename($datei) . " wurde hochgeladen.";
    }

    else {
        echo "Fehler!";
    }

    //copy("file/$nurname", "file/$datei");

}
?>

</div>
        </div>
    </div>
</div>
</body>
</html>
