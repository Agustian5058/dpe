<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">User Data</h1>

    <button href="#" class="btn btn-primary" data-target="#CreateUserModal" data-toggle="modal">Add New User</button>
    <div class="my-4"></div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Status</th>
                            <th>Position</th>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataTeam as $teams => $team) { ?>
                            <tr>
                                <td><?php echo $team["username"] ?></td>
                                <td><?php echo $team["user_fullname"] ?></td>
                                <td><?php echo $team["user_status"] ?></td>
                                <td><?php echo ucwords($team["user_type"]) ?></td>
                                <td><?php echo $team["user_id"] ?></td>
                                <td><?php echo $team["user_email"] ?></td>
                                <td><?php echo $team["user_address"] ?></td>
                                <td><?php echo $team["user_phone"] ?></td>
                                <td>
                                    <button class="user_update btn btn-warning" data-username="$username">Update</button>
                                    <?php if ($team["user_status"] == "Active") {
                                        echo '| <button class="btn btn-danger">Deactivate</button>';
                                    } else {
                                        echo '| <button class="btn btn-success">Activate</button>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Create User Modal-->
<div class="modal fade" id="CreateUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="user" method="POST" action="/team">
                <div class="modal-body">Input New User Data. Username must be unique.
                    <div class="my-4"></div>
                    <input type="hidden" name="user_status" value="Not Active">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Enter Username ...">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="user_fullname" placeholder="Enter User Name ...">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="user_type">
                            <option value="team">Select Position</option>
                            <option value="cashier">Cashier</option>
                            <option value="capster">Capster</option>
                            <option value="manager">Manager</option>
                            <option value="branch">Branch</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Enter Password ...">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="user_id" placeholder="Enter User Identity Number ...">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="user_email" placeholder="Enter User Email ...">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="user_address" placeholder="Enter User Address ...">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="user_phone" placeholder="Enter User Phone Number ...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Create User Modal-->
<div class="modal fade" id="UpdateUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="user" method="POST" action="/user">
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Modal with AJAX-->
<script type="text/javascript">
    $(document).ready(function() {
        $(".user_update").click(function() {
            var username = $(this).data("username");
            // AJAX request
            $.ajax({
                url: "/user/update",
                type: "post",
                data: {
                    username: username
                },
                success: function(response) {
                    // Add response in Modal body
                    $(".modal-body").html(response);

                    // Display Modal
                    $("#UpdateUserModal").modal("show");
                },
                error: function(jqxhr, status, exception) {
                    alert(jqxhr);
                }
            });
        });
    });
</script>