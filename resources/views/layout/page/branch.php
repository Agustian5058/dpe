<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Branch Data</h1>

    <button href="#" class="btn btn-primary" data-target="#CreateBranchModal" data-toggle="modal">Add New Branch</button>
    <div class="my-4"></div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Branch Name</th>
                            <th>Status</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataBranch as $branches => $branch) { ?>
                            <tr>
                                <td><?php echo $branch["username"] ?></td>
                                <td><?php echo $branch["user_fullname"] ?></td>
                                <td><?php echo $branch["user_status"] ?></td>
                                <td><?php echo $branch["user_email"] ?></td>
                                <td><?php echo $branch["user_address"] ?></td>
                                <td><?php echo $branch["user_phone"] ?></td>
                                <td>
                                    <button class="branch_update btn btn-warning" data-branch_id="$username">Update</button>
                                    <?php if ($branch["user_status"] == "Active") {
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

<!-- Create Branch Modal-->
<div class="modal fade" id="CreateBranchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Branch</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="user" method="POST" action="/branch">
                <div class="modal-body">Input New Branch Data. Username must be unique.
                    <div class="my-4"></div>
                    <input type="hidden" name="user_status" value="Not Active">
                    <input type="hidden" name="user_type" value="branch">
                    <input type="hidden" name="user_id">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Enter Username ...">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="user_fullname" placeholder="Enter Branch Name ...">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Enter Password ...">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="user_email" placeholder="Enter Branch Email ...">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="user_address" placeholder="Enter Branch Address ...">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="user_phone" placeholder="Enter Branch Phone Number ...">
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

<!-- Create Branch Modal-->
<div class="modal fade" id="UpdateBranchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Branch</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="user" method="POST" action="/branch">
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
        $(".branch_update").click(function() {
            var branch_id = $(this).data("branch_id");
            // AJAX request
            $.ajax({
                url: "/branch/update",
                type: "post",
                data: {
                    branch_id: branch_id
                },
                success: function(response) {
                    // Add response in Modal body
                    $(".modal-body").html(response);

                    // Display Modal
                    $("#UpdateBranchModal").modal("show");
                },
                error: function(jqxhr, status, exception) {
                    alert(jqxhr);
                }
            });
        });
    });
</script>