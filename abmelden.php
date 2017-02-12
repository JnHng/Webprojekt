
<?php
session_start();

include "conn.php";

header('Location: index.php');

session_destroy();
?>
