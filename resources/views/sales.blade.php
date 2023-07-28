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
                    <h1 class="h3 mb-2 text-gray-800">Data Sales</h1>
                    <button href="#" class="btn btn-primary" data-target="#CreateSalesModal" data-toggle="modal">Tambah Sales Baru</button>
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
                                            <th>Kode Sales</th>
                                            <th>Nama Sales</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Kode Sales</th>
                                            <th>Nama Sales</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @forelse ($dataSaless as $dataSales)
                                            <tr>
                                                <td>{{ $dataSales->sales_id }}</td>
                                                <td>{{ $dataSales->sales_name }}</td>
                                                <td>{{ $dataSales->sales_description }}</td>
                                                <td>
                                                    @if (session("role") == "Admin")
                                                        <a href="{{route('sales.edit', $dataSales->sales_id)}}" class="sales_update btn btn-warning">Ubah</a>
                                                        <a href="{{route('sales.destroy', $dataSales->sales_id)}}" class="sales_update btn btn-danger">Hapus</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <div class="alert alert-danger">
                                                Data Sales belum Tersedia.
                                            </div>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                <!-- Create Sales Modal-->
                <div class="modal fade" id="CreateSalesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Sales Baru</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form class="sales" method="POST" action="{{route('sales.store')}}">
                                @csrf
                                <div class="modal-body">Masukkan Data Sales Baru. Kode Sales tidak boleh sama.
                                    <div class="my-4"></div>
                                    <div class="form-group">
                                        <label>Kode Sales</label>
                                        <input type="text" class="form-control" name="sales_id" placeholder="Masukkan Kode Sales ...">
                                    </div>
                                    <div class="form-group">
                                    <label>Nama Lengkap Sales</label>
                                        <input type="text" class="form-control" name="sales_name" placeholder="Masukkan Nama Lengkap Sales ...">
                                    </div>
                                    <div class="form-group">
                                    <label>Keterangan</label>
                                        <input type="text" class="form-control" name="sales_description" placeholder="Masukkan Keterangan ...">
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