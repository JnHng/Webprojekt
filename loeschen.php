<?php
/**
 * Created by PhpStorm.
 * User: Illia
 * Date: 05.12.2016
 * Time: 12:10
 */



session_start();
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
    <b>Wollen Sie ihr Profil wirklich unwiderruflich löschen?</b><br>
    <br>
    <input type=submit name="Ja" value="Ja! Verdammt nochmal, Ja! Vernichten Sie alle Beweise!">
    <br>
    <input type=submit name="Nein" value="Ich...ich bin noch nicht soweit...">
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
        unset ($loesch);

        echo "Say goodbye as we dance with the devil tonight! <br>";

        /* $statement->execute(array("passwort1" => $passwort1, "id" => $id));
         unset ($statement);
         echo "Ihr Passwort wurde erfolgreich geändert!<br>"; */
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


session_destroy();

?>