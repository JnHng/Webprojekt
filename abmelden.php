<html>
<head>
    <title>Abmeldung</title>
</head>
<body>
<?php
session_start();

include "connection.php";

session_destroy();
echo ("Bis zum n�chsten Mal! <br> <a href=login.php>Zur Startseite</a>");
?>
</body>

</html>