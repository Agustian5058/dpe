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
                <!--  -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Tambah Data Transaksi</h1>
                <div class="my-4"></div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-xl-15 col-lg-12 col-md-9">
                                <div class="card o-hidden border-0 shadow-lg my-1">
                                    <div class="card-body p-0">
                                        <div class="col-lg-15 p-5">
                                            <form action="{{route('transaction.store')}}" class="user" method="POST">
                                                @csrf
                                                @if (session()->has("message"))
                                                <div class="alert alert-{{session('status')}}">
                                                    {{ session("message") }}
                                                </div>
                                                @endif
                                                <input type="hidden" value="{{$data->arrival_id}}" name="arrival_id">
                                                <input type="hidden" value="{{$data->customer_id}}" name="customer_id">
                                                <input type="hidden" value="{{$data->transaction_name}}" name="transaction_name">
                                                <div class="form-group">
                                                    <input type="text" value="{{$data->arrival_id}}" class="form-control" name="arrival_id" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" value="{{$data->arrival_date}}" class="form-control" name="arrival_date" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" value="{{$data->vehicle_name}}" class="form-control" name="vehicle_name" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" value="{{$data->customer_id}}" class="form-control" name="customer_id" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" value="{{$data->customer_name}}" class="form-control" name="customer_name" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" value="{{$data->transaction_name}}" class="form-control" name="transaction_name" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" name="transaction_debit_credit">
                                                        <option value="{{$data->credit_debit}}">{{$data->credit_debit}}</option>
                                                        <option value="Debit">Debit</option>
                                                        <option value="Credit">Credit</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="transaction_container_number" placeholder="Masukkan Nomor Container ...">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" value="{{$data->transaction_initial}}" class="form-control" name="note" placeholder="Masukkan Keterangan Transaksi ...">
                                                </div>
                                                <div class="form-group">
                                                    <input type="number" class="form-control" name="price" placeholder="Masukkan Harga ...">
                                                </div>
                                                @if (data->transaction_name == "Job")
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="goods_type" placeholder="Masukkan Jenis Barang ...">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="number" class="form-control" name="feet" placeholder="Masukkan Feet ...">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="number" class="form-control" name="qty" placeholder="Masukkan Qty ...">
                                                    </div>
                                                @endif
                                                <button type="submit" class="btn btn-primary btn-user btn-block col-lg-4" name="create">
                                                    Tambah
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
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