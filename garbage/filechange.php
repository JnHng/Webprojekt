<?php

include "header.php";
include "navigation.php";
?>

    <body>

    <div class="container">
        <div class="row">
            <div class="text-center" class="col-md-12">
    <form class="filechange" method="POST" action="">
        <h3 style="padding-bottom: 10px;">Dateinamen ändern</h3>
        <div class="form-group"><input class="form-control"  name="datei" placeholder="Neuer Dateiname" type=text></div>
        <input class="btn btn-link" type=submit name=submit value="Dateinamen ändern">
    </form>
                <?php

                if (isset ($_POST["submit"])) {

                    $login = $_SESSION['loginname'];
                    $newname = $_POST["datei"];

    $datei = $_FILES['bilddatei']['name'];
    $tmp_datei = $_FILES['bilddatei']['tmp_name'];
    $ordner = "uploads/";
    $ordner_datei = ($ordner . basename($datei));


    $dateiname = $_GET["name"];

    $indivdiual = $login.'_';




                    if (!empty($newname)) {
                        $suchen = ".";
                        $punkt = strpos($newname, $suchen);
                        if($punkt === false) {

        echo $array[0]."<br>".$array[1]."<br>";
            $array = explode(".",$dateiname);
        rename("$dateiname", "uploads/$indivdiual$newname.$array[1]");




//        echo $array[0]."<br>".$array[1]."<br>";
        $fileupdate = $db->prepare("UPDATE files SET name = :neuername WHERE username = :login AND name = :dateiname");

        $fileupdate->bindParam(':neuername', $neuername, PDO::PARAM_STR);
        $fileupdate->bindParam(':dateiname', $dateiname, PDO::PARAM_STR);
        $fileupdate->bindParam(':login', $_SESSION['loginname'], PDO::PARAM_STR);

        $fileupdate->execute();
        unset ($fileupdate);

        echo ' Ihr Dateiname wurde erfolgreich ge�ndert. Zur�ck zu <a href="../meine-dateien.php">dateien.php</a>';

        /* $statement->execute(array("passwort1" => $passwort1, "id" => $id));
         unset ($statement);
         echo "Ihr Passwort wurde erfolgreich ge?ndert!<br>"; */

        } else {
            echo "Bitte folgendes Zeichen nicht nutzen: '.'<br>";
        }


    } else {
        echo "Bitte geben Sie einen Namen ein!<br>";
    }


}

                ?>
            </div>
        </div>
    </div>
    </body>
</html>
