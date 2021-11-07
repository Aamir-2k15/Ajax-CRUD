<?php 
include('conn.php');
// print_r($_POST);
// echo $_POST['title'];

$title = $_POST['title'];
$body = $_POST['body'];

if($title == "" || $body ==""){
  $status = 0;
  $message ="Please enter required";
  return;
}

$sql = "INSERT INTO posts (title,body) VALUES ('$title','$body')";

// $sql = "INSERT INTO persons (first_name, last_name, email) VALUES ('$first_name', '$last_name', '$email')";

if ($conn->query($sql) === TRUE) {
  $message =  "New record created successfully";
  $status = 1;
} else {
    $message =  "Error: " . $sql . "<br>" . $conn->error;
    $status = 0;
}

$conn->close();
echo json_encode(array('Status' => $status, 'MSG' => $message));
exit;
?>