
<?php
session_start();
include "ses2.php";
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Passwort ändern</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<form class="change" method="POST" action="">
    <b>Passwort ändern:</b><br>
    <br>
    <input name="passwort1" placeholder="Neues Passwort:" type=password><br>
    <input name="passwort2" placeholder="Passwort wiederholen:" type=password><br>
    <br>
    <input type=submit name=submit value="Passwort ändern">
</form>
</body>
</html>

<?php

include "conn.php";

if (isset ($_POST["submit"])) {


    $login = $_SESSION['loginname'];
    $passwort1 = $_POST["passwort1"];
    $passwort2 = $_POST["passwort2"];
    $hash = md5($passwort1);



        if (!empty($passwort1) && !empty($passwort2) && $passwort1 == $passwort2) {

            try {
        $update = $db->prepare("UPDATE nutzer SET passwort = :hash WHERE username = :login");


        $update->bindParam(':hash', $hash, PDO::PARAM_STR);
        $update->bindParam(':login', $_SESSION['loginname'], PDO::PARAM_STR);
        $update->execute();

        echo "Ihr Passwort wurde erfolgreich geändert!<br>";

        /* $statement->execute(array("passwort1" => $passwort1, "id" => $id));
         unset ($statement);
         echo "Ihr Passwort wurde erfolgreich ge�ndert!<br>"; */
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    echo "Passwörter müssen identisch sein!<br>";
}


}

?>