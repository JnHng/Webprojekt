<html>
<head>
    <title>Abmeldung</title>
</head>
<body>
<?php
session_start();

include "connection.php";

session_destroy();
echo ("Bis zum nächsten Mal! <br> <a href=https://mars.iuk.hdm-stuttgart.de/~nl035/index.php>Zur Startseite</a>");
?>
</body>
</html>
