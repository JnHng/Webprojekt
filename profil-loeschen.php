<?php
/**
 * Created by PhpStorm.
 * User: Illia
 * Date: 05.12.2016
 * Time: 12:10
 */



session_start();
include "ses2.php";
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nutzer löschen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<form class="change" method="POST" action="">
    <b>Wollen Sie ihr Profil und ihre Dateien wirklich unwiderruflich löschen?</b><br>
    <br>
    <input type=submit name="Ja" value="Ja!">
    <br>
    <input type=submit name="Nein" value="Nein!">
</form>
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
        $loesch = $db->prepare("DELETE FROM nutzer WHERE username = :login");
        $loesch->bindParam(':login', $_SESSION['loginname'], PDO::PARAM_STR);


        $loesch->execute();


        $loesch = $db->prepare("DELETE FROM files WHERE username = :login");
        $loesch->bindParam(':login', $_SESSION['loginname'], PDO::PARAM_STR);


        $loesch->execute();


        echo "Ihr Porfil und ihre Daten wurden gelöscht.<br> <a href=login.php>Zur Startseite</a><br>";

        /* $statement->execute(array("passwort1" => $passwort1, "id" => $id));
         unset ($statement);
         echo "Ihr Passwort wurde erfolgreich ge�ndert!<br>"; */
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    unlink();

    session_destroy();
}




?>