
<!DOCTYPE html>

<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>Registrieren</title>
 <link rel="stylesheet" href="../style.css">
</head>
<body>


<form class="change" method="POST" action="../pwchange2.php?submit=1">
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

$id = ["id"];
$passwort1 = $_POST["passwort1"];
$passwort2 = $_POST["passwort2"];
/*$hash = md5($passwort1);*/

try {
include "conn.php";

$abfrage = "UPDATE nutzer SET passwort = :passwort1 WHERE id = :id";
 $stmt = $conn->prepare($abfrage);
 $stmt->execute();
 echo $stmt->rowCount() . " Das Update war erfolgreich.";
}
catch(PDOException $e)
{
 echo $abfrage . "<br>" . $e->getMessage();
}

$conn = null;
?>