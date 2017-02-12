<?php
include "header.php";
include "navigation.php";
session_start();
?>
    <body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="text-center" class="change" method="POST" action="">
                <h3>Wollen Sie diese Datei wirklich löschen?</h3>
                <input class="btn btn-link" type=submit name="Ja" value="Ja, sicher!">
                <input class="btn btn-link" type=submit name="Nein" value="Nein, lieber doch nicht.">
                </form>
            </div>
        </div>
    </div>


    </body>
    </html>

<?php

if (isset ($_POST["Nein"])) {


    echo header("Location: meine-dateien.php");
}

if (isset ($_POST["Ja"])) {


    include "conn.php";


    $login = $_SESSION['loginname'];



    try {
        $loesch = $db->prepare("DELETE FROM files WHERE username = :login AND fileid = :fileid");


        $loesch->bindParam(':login', $_SESSION['loginname'], PDO::PARAM_STR);
        $loesch->bindValue(':fileid', $_GET['fileid'], PDO::PARAM_INT);

        $loesch->execute();
        unset ($loesch);

        echo ' Ihre Datei wurde gelöscht. Zurück zu <a href="meine-dateien.php">dateien.php</a>';

        /* $statement->execute(array("passwort1" => $passwort1, "id" => $id));
         unset ($statement);
         echo "Ihr Passwort wurde erfolgreich ge?ndert!<br>"; */
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    echo header("Location: meine-dateien.php");
}


?>
