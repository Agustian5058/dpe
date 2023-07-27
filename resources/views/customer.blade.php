<!DOCTYPE html>
<html lang="en">
@include('layout.header')
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
    @include('layout.sidebar')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                @include('layout.topbar')
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Customer</h1>
                    <button href="#" class="btn btn-primary" data-target="#CreateCustomerModal" data-toggle="modal">Tambah Customer Baru</button>
                    <div class="my-4"></div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    @if (session()->has("message"))
                                    <div class="alert alert-{{session('status')}}">
                                        {{ session("message") }}
                                    </div>
                                    @endif
                                    <thead>
                                        <tr>
                                            <th>Kode Customer</th>
                                            <th>Nama Customer</th>
                                            <th>Handle Oleh</th>
                                            <th>Nomor HP</th>
                                            <th>Alamat</th>
                                            <th>Provinsi</th>
                                            <th>Kota</th>
                                            <th>Kode Pos</th>
                                            <th>Fax</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Kode Customer</th>
                                            <th>Nama Customer</th>
                                            <th>Handle Oleh</th>
                                            <th>Nomor HP</th>
                                            <th>Alamat</th>
                                            <th>Provinsi</th>
                                            <th>Kota</th>
                                            <th>Kode Pos</th>
                                            <th>Fax</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @forelse ($dataCustomers as $dataCustomer)
                                            <tr>
                                                <td>{{ $dataCustomer->customer_id }}</td>
                                                <td>{{ $dataCustomer->customer_name }}</td>
                                                <td>{{ $dataCustomer->customer_sales }}</td>
                                                <td>{{ $dataCustomer->customer_phone }}</td>
                                                <td>{{ $dataCustomer->customer_address }}</td>
                                                <td>{{ $dataCustomer->customer_province }}</td>
                                                <td>{{ $dataCustomer->customer_city }}</td>
                                                <td>{{ $dataCustomer->customer_postal_code }}</td>
                                                <td>{{ $dataCustomer->customer_fax }}</td>
                                                <td>
                                                    @if (session("role") == "Admin")
                                                        <a href="{{route('customer.edit', $dataCustomer->customer_id)}}" class="user_update btn btn-warning">Ubah</a>
                                                        <!-- <a href="{{route('customer.destroy', $dataCustomer->customer_id)}}" class="user_update btn btn-danger">Hapus</a> -->
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <div class="alert alert-danger">
                                                Data Customer belum Tersedia.
                                            </div>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                <!-- Create User Modal-->
                <div class="modal fade" id="CreateCustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Customer Baru</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form class="user" method="POST" action="{{route('customer.store')}}">
                                @csrf
                                <div class="modal-body">Masukkan Data Customer Baru. Kode Customer tidak boleh sama.
                                    <div class="my-4"></div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="customer_id" placeholder="Masukkan Kode Customer ...">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="customer_name" placeholder="Masukkan Nama Customer ...">
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="customer_sales">
                                            <option value="">-- Pilih Handle Oleh --</option>
                                            @foreach ($dataSaless as $dataSales)
                                                <option value="{{$dataSales->sales_id}}">{{$dataSales->sales_id}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="customer_phone" placeholder="Masukkan Nomor HP ...">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="customer_address" placeholder="Masukkan Alamat ...">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="customer_province" placeholder="Masukkan Provinsi ...">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="customer_city" placeholder="Masukkan Nama Kota ...">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="customer_postal_code" placeholder="Masukkan Kode Pos ...">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="customer_fax" placeholder="Masukkan Nomor Fax ...">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                    <button class="btn btn-primary" type="submit">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->
            @include('layout.footer')
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    @include('layout.js')
</body>
</html>