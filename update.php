<?php 
include('conn.php');
//  print_r($_POST);
// echo $_POST['title'];
$id = $_POST['id'];
$title = $_POST['title'];
$body = $_POST['body'];

if($title == "" || $body ==""){
  $status = 0;
  $message ="Please enter required";
  return;
}


$sql = "UPDATE posts SET title='$title', body='$body' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  $status = 1;
  $message = "Record updated successfully";
} else {
  $status = 0;
  $message ="Error updating record: " . $conn->error;
}

$conn->close();
echo json_encode(array('Status' => $status, 'MSG' => $message));
exit;
?>