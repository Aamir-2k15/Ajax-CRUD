<?php 
include('conn.php');
//  print_r($_POST);
// echo $_POST['title'];
$id = $_POST['id'];
$sql = "SELECT * FROM posts WHERE id=$id";

$result = $conn->query($sql);
$title = "";
$body = "";
if ($result->num_rows > 0) {

  while($row = $result->fetch_array()) {
  
    
    $status = 1;
    $message = "";
    $title =$row['title'];
    $body =$row['body'];
  }


} else {
    $message =  "No recrods found!";
    $status = 0;
}

$conn->close();
echo json_encode(array('Status' => $status, 'MSG' => $message, 'id'=>$id, 'title'=>$title, 'body'=>$body));
exit;
?>