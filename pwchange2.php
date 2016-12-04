
<?php
session_start();
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrieren</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<form class="change" method="POST" action="pwchange2.php?submit=1">
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

if (isset ($_GET[submit])) {

    $id = ["id"];
    $id = $_SESSION['id'];
    $login = $_SESSION['loginname'];
    $passwort1 = $_POST["passwort1"];
    $passwort2 = $_POST["passwort2"];
    /* $hash = md5($passwort1); */

    echo $login;


    if (isset($passwort1)) {

        if ($passwort1 != "" && $passwort2 != "" && $passwort1 == $passwort2) {

            try {
                $statement = $db->prepare("UPDATE nutzer SET passwort = :passwort1 WHERE username = :login");


                $statement->bindParam(':passwort1', $passwort1, PDO::PARAM_STR);
                $statement->bindValue(':login', $_SESSION['loginname'], PDO::PARAM_INT);
                $statement->execute();;
                unset ($statement);
                echo "Ihr Passwort wurde erfolgreich geändert!$login, $passwort1<br>";

                /* $statement->execute(array("passwort1" => $passwort1, "id" => $id));
                 unset ($statement);
                 echo "Ihr Passwort wurde erfolgreich geändert!<br>"; */
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            echo "Passwörter müssen identisch sein!<br>";
        }

    }
}

?>