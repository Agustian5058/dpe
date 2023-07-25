<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Product Data</h1>

    <button href="#" class="btn btn-primary" data-target="#CreateProductModal" data-toggle="modal">Add New Product</button>
    <div class="my-4"></div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Type</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataProduct as $products => $product) { ?>
                            <tr>
                                <td><?php echo $product["product_name"] ?></td>
                                <td><?php echo $product["product_type"] ?></td>
                                <td><?php echo $product["product_stock"] ?></td>
                                <td>
                                    <button class="user_update btn btn-warning" data-product_id="$product_id">Update</button>
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
<div class="modal fade" id="CreateProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="user" method="POST" action="/product">
                <div class="modal-body">Input New Product Data.
                    <div class="my-4"></div>
                    <input type="hidden" name="product_stock" value="0">
                    <div class="form-group">
                        <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name ...">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="product_type">
                            <option value="team">Select Product Type</option>
                            <option value="packet">Packet</option>
                            <option value="treatment">Treatment</option>
                            <option value="product">Product</option>
                        </select>
                    </div>
                    <?php if (session()->get("user_type") === "admin") { ?>
                        <div class="custom-control custom-checkbox small">
                            <input type="checkbox" class="custom-control-input" id="all_branch" name="all_branch">
                            <label class="custom-control-label" for="all_branch">Add to All Branch</label>
                        </div>
                    <?php } ?>
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