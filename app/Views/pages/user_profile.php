<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        #slider_heading {
            color: #fff;
            font-size: 20px;
            font-weight: 400;
            font-family: "Inter", sans-serif;
            width: fit-content;
            display: inline-block;
            background-color: #198754;
            padding: 6px;
            border-radius: 20px 20px 0px 0px;
            line-height: 25px;
            text-align: center;
        }

        #slider_content {
            color: #fff;
            font-size: 15px;
            font-weight: 400;
            line-height: 30px;
            background: #0000006e;
            width: fit-content;
            border-radius: 25px;
            padding: 5px;
        }

        .home_event {

            overflow-y: scroll;
            scrollbar-width: thin;
            scrollbar-color: #007 #fea116;
            height: 420px;
            overflow: auto;
        }

        .action-box {
            height: auto !important;
        }
    </style>

</head>

<body id="bg">
    <div class="page-wraper">



        <?php echo view('pages/layout/header.php'); ?>


        <div class="page-content bg-white ">

            <div class="content-block">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($user_all_data)) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $user_all_data[0]['id'] ?></th>
                                <td><?php echo $user_all_data[0]['name'] ?></td>
                                <td><?php echo $user_all_data[0]['email'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" onclick="editUser(<?php echo $user_all_data[0]['id'] ?>)">Edit</button>
                                </td>
                            </tr>
                        <?php

                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>

        <div class="">
            <div id="heading" class="modal fade mt-4" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="heading_title"></h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form method="post" id="userUpdate" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div id="div-msg-save" class="alert  alert-dismissible fade show" style="display:none"></div>
                                <div class="row">
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <label class="floating-label">Update Name</label>
                                            <input type="text" class="form-control" id="edit_name" name="edit_name" value="">
                                        </div>
                                        <div class="form-group">
                                            <label class="floating-label">Update Email</label>
                                            <input type="email" class="form-control" id="edit_email" name="edit_email" value="">
                                        </div>
                                        <div class="form-group">
                                            <label class="floating-label">Update Password</label>
                                            <input type="password" class="form-control" id="edit_password" name="edit_password" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-12" id="imageFeedback">
                                        <div class="form-group">
                                            <label class="floating-label">Update Profile</label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="fileInput" name="edit_img1" value="" require>
                                                    <label class="custom-file-label" for="fileInput">Choose file</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="user_id" id="user_id">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                <button type="submit" class="btn btn-primary" id="btn-heading">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!-- LOADING JS -->
    <script>

    </script>

    <script type="text/javascript">
        function editUser(id) {
            $("#heading").modal("show");
            $.ajax({
                type: "POST",
                url: "<?php echo base_url("editUser") ?>",
                data: {
                    id: id
                },

                success: function(responce) {

                    let datauser = JSON.parse(responce);
                    let user = datauser.userData;
                    console.log(user[0].user_pic)
                    $("#heading").modal("show");
                    $('#edit_name').val(user[0].name);
                    $('#edit_email').val(user[0].email);
                    $('#user_id').val(user[0].id);
                    $('#edit_password').val(user[0].password);
                    $('#fileInput').val(user[0].user_pic);
                }
            });
        }












        $(document).ready(function() {
            $("#userUpdate").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('userUpdate') ?>",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: "json",
                    success: function(responce) {
                        if (responce.status) {
                            $("#btn-heading").html("Please Wait....")
                            $('#div-msg-save').addClass("alert-success").removeClass("alert-danger").html(responce.msg).slideDown(500).delay(2000).slideUp(function() {
                                window.location.reload();
                            });
                        } else {
                            // $('#btn-heading').attr('disabled', false);
                            $('#div-msg-save').addClass("alert-danger").removeClass("alert-success").html(responce.msg).slideDown(500).delay(5000).slideUp(500);
                        }
                    }
                });
            });
        });
    </script>





</body>

</html>