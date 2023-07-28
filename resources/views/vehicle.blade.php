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
                    <h1 class="h3 mb-2 text-gray-800">Data Kapal</h1>
                    <button href="#" class="btn btn-primary" data-target="#CreateVehicleModal" data-toggle="modal">Tambah Kapal Baru</button>
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
                                            <th>Nomor Kapal</th>
                                            <th>Jenis Kendaraan</th>
                                            <th>Nama Kapal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nomor Kapal</th>
                                            <th>Jenis Kendaraan</th>
                                            <th>Nama Kapal</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @forelse ($dataVehicles as $dataVehicle)
                                            <tr>
                                                <td>{{ $dataVehicle->vehicle_id }}</td>
                                                <td>{{ $dataVehicle->vehicle_type }}</td>
                                                <td>{{ $dataVehicle->vehicle_name }}</td>
                                                <td>
                                                    <a href="{{route('vehicle.edit', $dataVehicle->vehicle_id)}}" class="user_update btn btn-warning">Ubah</a>
                                                    <!-- <a href="{{route('vehicle.destroy', $dataVehicle->vehicle_id)}}" class="user_update btn btn-danger">Hapus</a> -->
                                                </td>
                                            </tr>
                                        @empty
                                            <div class="alert alert-danger">
                                                Data Kapal belum Tersedia.
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
                <div class="modal fade" id="CreateVehicleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Kapal Baru</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form class="user" method="POST" action="{{route('vehicle.store')}}">
                                @csrf
                                <div class="modal-body">Masukkan Data Kapal Baru. Nomor Kapal tidak boleh sama.
                                    <div class="my-4"></div>
                                    <div class="form-group">
                                    <label>Nomor Kapal</label>
                                        <input type="text" class="form-control" name="vehicle_id" placeholder="Masukkan Nomor Kapal ...">
                                    </div>
                                    <div class="form-group">
                                    <label>Jenis Kapal</label>
                                        <select class="form-control" name="vehicle_type">
                                            <option value="Kapal">-- Pilih Jenis Kapal (Kapal)--</option>
                                            <option value="Kapal">Kapal</option>
                                            <option value="Truk">Truk</option>
                                            <option value="Mobil">Mobil</option>
                                            <option value="Motor">Motor</option>
                                            <option value="Becak">Becak</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                    <label>Nama Kapal</label>
                                        <input type="text" class="form-control" name="vehicle_name" placeholder="Masukkan Nama Kapal ...">
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