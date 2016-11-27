<?php

$dsn="mysql:host=localhost;dbname=u-nl035";
$dbuser="nl035";
$dbpass="FahNae5ooR";

$db = new PDO($dsn, $dbuser, $dbpass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>