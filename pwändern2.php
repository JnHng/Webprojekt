<?php



try {
include "connection.php";

$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";

// Prepare statement
$stmt = $conn->prepare($sql);

// execute the query
$stmt->execute();

// echo a message to say the UPDATE succeeded
echo $stmt->rowCount() . " records UPDATED successfully";
}
catch(PDOException $e)
{
 echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>