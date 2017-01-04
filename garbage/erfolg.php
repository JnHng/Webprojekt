<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 08.11.2016
 * Time: 15:04
 */
session_start();
echo $_SESSION["loginname"];

echo ' ist ein Erfolg! Hier gehts weiter zu den <a href="../dateien.php">Dateien</a>!';

