<?php

$dsn="mysql:host=localhost;dbname=u-nl035";
$dbuser="nl035";
$dbpass="FahNae5ooR";

try {
    $db=new PDO($dsn,$dbuser,$dbpass);
}
catch(PDOException $e) {
    echo $e->getMessage();
    die();
}
