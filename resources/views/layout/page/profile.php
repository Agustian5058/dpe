<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Profile Data</h1>

    <button href="#" class="btn btn-primary" data-target="#ChangePasswordModal" data-toggle="modal">Change Password</button>
    <div class="my-4"></div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-xl-15 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-1">
                        <div class="card-body p-0">
                            <div class="col-lg-15 p-5">
                                <form action="" class="user" method="POST">
                                    <?php if (session()->getFlashdata("message")) { ?>
                                        <div class="alert alert-<?php echo session()->getFlashdata("status"); ?>">
                                            <?php echo session()->getFlashdata("message"); ?>
                                        </div>
                                    <?php } ?>
                                    <input type="hidden" value="<?php echo $dataUser["username"] ?>" name="username">
                                    <div class="form-group">
                                        <input type="text" value="<?php echo $dataUser["username"] ?>" class="form-control" name="username" disabled>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" value="<?php echo $dataUser["user_id"] ?>" class="form-control" name="user_id" placeholder="Enter ID ..." <?php if (!($dataUser["user_type"] === "admin")) {
                                                                                                                                                                                            echo "disabled";
                                                                                                                                                                                        } ?>>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" value="<?php echo $dataUser["user_email"] ?>" class="form-control" name="user_email" placeholder="Enter Email ..." <?php if (!($dataUser["user_type"] === "admin")) {
                                                                                                                                                                                                        echo "disabled";
                                                                                                                                                                                                    } ?>>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" value="<?php echo $dataUser["user_fullname"] ?>" class="form-control" name="user_fullname" placeholder="Enter Fullname ...">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" value="<?php echo $dataUser["user_address"] ?>" class="form-control" name="user_address" placeholder="Enter Address ...">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" value="<?php echo $dataUser["user_phone"] ?>" class="form-control" name="user_phone" placeholder="Enter Phone Number ...">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block col-lg-4" name="login">
                                        Update
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Create Branch Modal-->
<div class="modal fade" id="ChangePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="user" method="POST" action="/profile-password">
                <div class="modal-body">Input New Password.
                    <div class="my-4"></div>
                    <input type="hidden" name="action" value="password_update">
                    <input type="hidden" name="username" value="<?php echo $dataUser['username'] ?>">
                    <div class="form-group">
                        <input type="password" class="form-control" name="current_password" placeholder="Enter Current Password ...">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="new_password" placeholder="Enter New Password ...">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="confirmation_password" placeholder="Re-enter New Password ...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Change</button>
                </div>
            </form>
        </div>
    </div>
</div>