<!doctype html>
<html lang="en">

<head>
    <title>CRUD</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fontawesome.com/v4.7/assets/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css"
        integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

</head>

<body>
    <div class="container mt-4 pt-4">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">CRUD <small class="muted">test</small></h3>

            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <p id="response" class="lead"></p>
            </div>
            <div class="col-md-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary float-right ml-auto mr-0" data-toggle="modal"
                    data-target="#add_modal">
                    <i class="fa fa-folder"></i>
                    Add Post
                </button>

                <!-- Modal -->
                <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="create_post">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" name="title" id="title"
                                            aria-describedby="helpId" placeholder="Title">
                                        <small id="helpId" class="form-text text-muted">Help text</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="body">Body</label>
                                        <textarea class="form-control" name="body" id="body" rows="3"
                                            placeholder="Body"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="create">
                                        <i class="fas fa-save"></i>
                                        Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Ends Modal -->

            </div>
        </div>

        <div class="row mt-4 pt-4">
            <div class="col-md-12 table-responsive">
                <table class="table table-hover table-striped table-bordered table-inverse table-full">
                    <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Body</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="records_holder">                   

                    <?php 
include('conn.php');
// print_r($_POST);
// echo $_POST['title'];

//$sql = "SELECT * FROM posts ORDER BY id DESC";
$sql = "SELECT * FROM posts ORDER BY id ASC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
$n = 1;
  while($row = $result->fetch_assoc()) {
    //ob_start();
    //$records = "";
    ?>
    <tr id="<?php echo $n;?>">
                            <td scope="row"><?php echo $row["id"];?></td>
                            <td><?php echo $row["title"];?></td>
                            <td><?php echo $row["body"];?></td>
                            <td>
                                <a href="#" class="btn btn-outline-secondary view" title="View" data-id="<?php echo $row["id"];?>">
                                <i class="fas fa-eye"></i>
                                </a>

                                <a href="#" class="btn btn-outline-primary edit" title="Edit" data-id="<?php echo $row["id"];?>">
                                <i class="fas fa-pencil-square-o" aria-hidden="true"></i>
                              </a>

                                <a href="#" class="btn btn-outline-danger delete" title="Delete" data-id="<?php echo $row["id"];?>">
                                  <i class="fas fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
    <?php
    
   //echo $record = ob_get_clean();
//    $records .= $record;
//    $status = 1;
//    $message = "";
//    $n++;
  }


} else {
    $message =  "No recrods found!";
    $status = 0;
}

$conn->close();
//echo $records;
?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- View -->
    <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title">View Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <p id="title_show"> </p>
                        </div>

                        <div class="form-group">
                            <label for="body">Body</label>
                            <p id="body_show"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Ends View -->



    <!-- Edit -->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="edit_form">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title_edit"
                                aria-describedby="helpId" placeholder="Title">
                            <small id="helpId" class="form-text text-muted">Help text</small>
                        </div>

                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea class="form-control" name="body" id="body_edit" rows="3"
                                placeholder="Body"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Ends Modal -->


    <!-- Delete -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="edit_form">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="lead">Are you sure you want to delete this?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="delete_button" class=" btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                            Yes delete it</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Ends Modal -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
    <script>
        function get_records(){
            let records_holder = $('tbody#records_holder');
            
            $.ajax({
                //debugger;
                url: 'records.php',
                type: "post",
                dataType: "json",
                                   async: false
                // data: form_data,
                //                    beforeSend: ez_loading_func()
            }).done(function (response) {
                // debugger;
                //response = JSON.parse(response);
                console.log(response);
                if (response.Status == 1) {
                    records_holder.html(response.records);
                } else {
                    $('#response').addClass('text-danger').html(response.MSG);
                }
            }); //ajax done

        }//ends get_records
        $('#create').on('click', function () {
            let form_data = $('form#create_post').serialize();
            console.log(form_data);
            $.ajax({
                //debugger;
                url: 'create.php',
                type: "post",
                dataType: "json",
                //                    async: false
                data: form_data,
                //                    beforeSend: ez_loading_func()
            }).done(function (response) {
                // debugger;
                // console.log(response);
                if (response.Status == 1) {
                    $('#response').addClass('text-success').html(response.MSG);
                    $('form#create_post')[0].reset();
                    $("#add_modal").modal('hide');
                    get_records();
                } else {
                    $('#response').addClass('text-danger').html(response.MSG);
                    $('form#create_post')[0].reset();
                    $('#add_modal').modal('hide');
                }
            }); //ajax done


        });

        $(document).ready(function () {
            //get_records();
            $(".view").click(function () {
                let view_id = $(this).data('id');
                $('#view #title_show').html(view_id);
                $('#view #body_show').html(view_id);
                $('#view').modal('show');
            });

            $(".edit").click(function () {
                let edit_id = $(this).data('id');
                $('#edit #title_edit').val(edit_id);
                $('#edit #body_edit').val(edit_id);
                $('#edit').modal('show');
            });

            $(".delete").click(function () {
                let delete_id = $(this).data('id');
                $('#edit p.lead').after('<h5>' + delete_id + '</h5>');
                console.log(delete_id);
                $('#delete').modal('show');
            });
        });
    </script>
</body>

</html>