<?php
$site_title = "Alles löschen";
include "header.php";
include "navigation.php";
?>

    <body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="text-center" class="change" method="POST" action="">
                    <h3>Wollen Sie Ihr Profil wirklich löschen?</h3>
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


    echo header("Location: dateien.php");
}

if (isset ($_POST["Ja"])) {

    include "conn.php";

    $id = ["id"];
    $login = $_SESSION['loginname'];

    try {

        $deleteall = "SELECT name, username FROM files WHERE username='$login'";


        $ergebnis = $db->query($deleteall);
        while($row = $ergebnis->fetch(PDO::FETCH_ASSOC)){

            unlink($row['name']);

        }

        $loesch = $db->prepare("DELETE FROM files WHERE username = :login");
        $loesch->bindParam(':login', $_SESSION['loginname'], PDO::PARAM_STR);


        $loesch->execute();



        echo "All ihre Dateien wurden gelöscht! <br>";



        $loesch = $db->prepare("DELETE FROM nutzer WHERE username = :login");
        $loesch->bindParam(':login', $_SESSION['loginname'], PDO::PARAM_STR);


        $loesch->execute();


        $loesch = $db->prepare("DELETE FROM files WHERE username = :login");
        $loesch->bindParam(':login', $_SESSION['loginname'], PDO::PARAM_STR);


        $loesch->execute();


        header ("Location: profil-geloescht.php");


    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    session_destroy();
}




?>