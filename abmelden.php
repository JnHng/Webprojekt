<html>
<head>
    <title>Abmeldung</title>
</head>
<body>
<?php
session_start();

include "conn.php";

session_destroy();
echo ("Bis zum nächsten Mal! <br> <a href=StartseiteNaked.html>Zur Startseite</a>");
?>
</body>

</html>