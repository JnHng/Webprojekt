<?php

include "connection.php";

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$delete = "DELETE FROM user WHERE id=[0]";

$db->exec($delete);
echo "Ihr Nutzeraccount wurde gel�scht";


echo $delete . "<br>";


$db = null;
?>