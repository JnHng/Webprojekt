<?php
$title = "File Teilen";
include "conn.php";

$fileid = $_GET['fileid'];

?>
<body>
<?php
$result = $db->query("SELECT * from files WHERE fileid = $fileid")->fetchObject();


if($result == false) {
    echo "Die FileId ist nicht korrekt!";
    exit();
}

echo md5($result->name);

?>
<img src="<?php echo $result->name; ?>" alt=""/>
</body>
</html>