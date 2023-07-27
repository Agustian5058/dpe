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
                    <h1 class="h3 mb-2 text-gray-800">Data Kedatangan Kapal</h1>
                    <button href="#" class="btn btn-primary" data-target="#CreateArrivalModal" data-toggle="modal">Tambah Kedatangan Kapal Baru</button>
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
                                            <th>Kode Kedatangan</th>
                                            <th>Kode Kapal</th>
                                            <th>Nama Kapal</th>
                                            <th>Tanggal Kedatangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Kode Kedatangan</th>
                                            <th>Kode Kapal</th>
                                            <th>Nama Kapal</th>
                                            <th>Tanggal Kedatangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @forelse ($dataArrivals as $dataArrival)
                                            <tr>
                                                <td>{{ $dataArrival->arrival_id }}</td>
                                                <td>{{ $dataArrival->arrival_vehicle }}</td>
                                                <td>{{ $dataArrival->vehicle_name }}</td>
                                                <td>{{ $dataArrival->arrival_date }}</td>
                                                <td>
                                                    @if (session("role") == "Admin")
                                                        <a href="{{route('arrival.destroy', $dataArrival->arrival_id)}}" class="user_update btn btn-danger">Hapus</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <div class="alert alert-danger">
                                                Data Kedatangan Kapal belum Tersedia.
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
                <div class="modal fade" id="CreateArrivalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Kedatangan Kapal Baru</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form class="user" method="POST" action="{{route('arrival.store')}}">
                                @csrf
                                <div class="modal-body">Masukkan Data Kedatangan Kapal Baru. Kedatangan Kapal tidak boleh sama.
                                    <div class="my-4"></div>
                                    <div class="form-group">
                                        <select class="form-control" name="arrival_vehicle">
                                            <option value="">-- Pilih Kapal--</option>
                                            @foreach ($dataVehicles as $dataVehicle)
                                                <option value="{{$dataVehicle->vehicle_id}}">{{$dataVehicle->vehicle_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="arrival_date" placeholder="dd-mm-yyyy" min="01-01-1997" max="31-12-2050">
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