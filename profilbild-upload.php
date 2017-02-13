
<?php
session_start();
?>
<?php
$site_title = "Profilbild";
include "header.php";
include "navigation.php";
?>

<body>
<div class="row">
    <div class="container">
        <div class="text-center" class="col-md-12">
            <h3>Hier hochladen!</h3>

            <form action="profilbild-upload.php" method="post" enctype="multipart/form-data">
                <input style="margin-left: auto; margin-right: auto; padding-top: 10px;" class="text-center" type="file" name="bilddatei" id="bilddatei">
                <input type="submit" name="submit" value="Upload">
            </form>

            <div style="padding-top: 20px;">

                <?php

            if(isset($_POST['submit'])) {



                $datei = $_FILES['bilddatei']['name'];
                $tmp_datei = $_FILES['bilddatei']['tmp_name'];
                $size = $_FILES['bilddatei']['size'];
                $max = 1000000;
                $ordner = "Profilbilder/";
                $ordner_datei = ($ordner.basename($datei));
                $dateiform = pathinfo($ordner_datei, PATHINFO_EXTENSION);

                if (empty($datei)) {
                    echo "Wählen Sie eine Datei aus";
                    exit();
                }


                if($dateiform != "jpg" && $dateiform != "png" && $dateiform != "jpeg") {
                    echo "Nur folgende Formate werden akzeptiert: JPG, JPEG und PNG.";
                    exit();
                }



                if ($size > $max) {
                    echo "Zu gross!";
                    exit();
                }


                if (isset($datei)) {

                    header("Location: profilvorlage_nick.php");

                }


                if (move_uploaded_file($tmp_datei, $ordner . $datei)) {
                    echo ' - Bild ansehen: <a href="'.$ordner_datei.'">'.$ordner_datei.'</a>';
                    $up = $db->prepare("UPDATE nutzer SET profilbild = :ordner_datei WHERE username = :login");
                    $up->bindParam(':ordner_datei', $datei, PDO::PARAM_STR);
                    $up->bindParam(':login', $login, PDO::PARAM_STR);
                    $up->execute();
                } else {
                    echo "Fehler!";
                }


                $sql = "SELECT * FROM nutzer WHERE username='$login' AND profilbild='$datei'";

                $query = $db->query($sql);
                if ($query == false) {
                    die(var_export($db->errorinfo(), TRUE));
                }


                if ($zeile = $query->fetch(PDO::FETCH_OBJ)) {

                    if ($zeile->profilbild == $datei && $zeile->username == $login) {
                        $_SESSION["loginname"] = $zeile->username;
                        $_SESSION["profilbild"] = $zeile->profilbild;
                    }


                }

                else {
                    echo "Fehler aufgetreten";
                }



            }
            ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>






