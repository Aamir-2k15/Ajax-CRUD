<?php 
include('conn.php');

$id = $_POST['id'];

$sql = "DELETE FROM posts WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  $status = 1;
  $message = "Record deleted successfully";
} else {
  $status = 0;
  $message ="Error updating record: " . $conn->error;
}

$conn->close();
echo json_encode(array('Status' => $status, 'MSG' => $message));
exit;
?>