<?php 
include('conn.php');
// print_r($_POST);
// echo $_POST['title'];

$sql = "SELECT * FROM posts ORDER BY id DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
$n = 1;
  while($row = $result->fetch_assoc()) {
    ob_start();
    $records[] = "";
    ?>
    <tr id="<?php echo $n;?>">
                            <td scope="row"><?php echo $row["id"];?></td>
                            <td><?php echo $row["title"];?></td>
                            <td id="row_body"><?php echo $row["body"];?></td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-outline-secondary view" title="View" data-id="<?php echo $row["id"];?>">
                                <i class="fas fa-eye"></i>
                                </a>

                                <a href="javascript:void(0)" class="btn btn-outline-primary edit" title="Edit" data-id="<?php echo $row["id"];?>">
                                <i class="fas fa-pencil-square-o" aria-hidden="true"></i>
                              </a>

                                <a href="javascript:void(0)" class="btn btn-outline-danger delete" title="Delete" data-id="<?php echo $row["id"];?>">
                                  <i class="fas fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
    <?php
    
    $record = ob_get_clean();
    $records[] .= $record;
    $status = 1;
    $message = "";
    $n++;
  }


} else {
    $message =  "No recrods found!";
    $status = 0;
}

$conn->close();
echo json_encode(array('Status' => $status, 'MSG' => $message, 'records'=>$records));
exit;
?>