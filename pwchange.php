
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrieren</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<form action="pwchange.php?submit=1" method="POST"role="form">

    <div class="form-group">
        <label for="passwort1">Neues Passwort</label>
        <input type="password" class="form-control" id="passwort1" name="passwort1" placeholder="Neues Passwort">
    </div>
    <div class="form-group">
        <label for="passwort2">Neues Passwort wiederholen</label>
        <input type="password" class="form-control" id="passwort2" name="passwort2" placeholder="Neues Passwort wiederholen">
    </div>
    <button type="submit" class="btn btn-primary btn-md">Passwort ändern</button>
</form>
</br>
</body>
</html>

<?php

include "connection.php";

$id = ["id"];
$passwort1 = $_POST["passwort1"];
$passwort2 = $_POST["passwort2"];
$hash = md5($passwort1);

if(isset($passwort1)) {

    if ($passwort1 != "" && $passwort2 !="" && $passwort1 == $passwort2) {

        try {
            $statement = $db->prepare("UPDATE user SET passwort = :hash WHERE id = :id");
            $statement->bindParam(':hash', $hash, PDO::PARAM_STR);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();;
            unset ($statement);
            echo "Ihr Passwort wurde erfolgreich geändert!<br>";
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    else {
        echo "Passwörter müssen identisch sein!<br>";
    }

}

?>