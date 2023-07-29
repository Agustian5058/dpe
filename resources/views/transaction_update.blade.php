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
                <h1 class="h3 mb-2 text-gray-800">Update Jenis Transaksi Data</h1>
                <div class="my-4"></div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-xl-15 col-lg-12 col-md-9">
                                <div class="card o-hidden border-0 shadow-lg my-1">
                                    <div class="card-body p-0">
                                        <div class="col-lg-15 p-5">
                                            <form action="{{route('transaction.update', $dataTransaction->transaction_id)}}" class="user" method="POST">
                                                @csrf
                                                @method('PUT')
                                                @if (session()->has("message"))
                                                <div class="alert alert-{{session('status')}}">
                                                    {{ session("message") }}
                                                </div>
                                                @endif
                                                <input type="hidden" value="{{$dataTransaction->transaction_id}}" name="transaction_id">
                                                <div class="form-group">
                                                    <label>Nomor Transaksi</label>
                                                    <input type="text" value="{{$dataTransaction->transaction_id}}" class="form-control" name="transaction_id" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Transaksi</label>
                                                    <input type="text" value="{{$dataTransaction->transaction_date}}" class="form-control" name="transaction_id" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Data Kapal</label>
                                                    <input type="text" value="{{$dataArrival->arrival_date}} {{$dataArrival->vehicle_id}} {{$dataArrival->vehicle_name}}" class="form-control" name="arrival_id" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Data Customer</label>
                                                    <input type="text" value="{{$dataCustomer->customer_name}} {{$dataCustomer->customer_id}}" class="form-control" name="customer_id" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis Transaksi</label>
                                                    <input type="text" value="{{$dataTransactionType->transaction_name}}" class="form-control" name="transaction_name" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Debit / Kredit</label>
                                                    <input type="text" value="{{$dataTransactionType->transaction_debit_credit}}" class="form-control" name="transaction_debit_credit" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <input type="text" value="{{$dataTransaction->note}}" class="form-control" name="note" placeholder="Masukkan Keterangan ...">
                                                </div>
                                                <div class="form-group">
                                                    <label>Harga</label>
                                                    <input type="number" value="{{$dataTransaction->price}}" class="form-control" name="price" placeholder="Masukkan Harga ...">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nomor Container</label>
                                                    <input type="text" value="{{$dataTransaction->transaction_container_number}}" class="form-control" name="transaction_container_number" placeholder="Masukkan Nomor Container ...">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis Barang</label>
                                                    <input type="text" value="{{$dataTransaction->goods_type}}" class="form-control" name="goods_type" placeholder="Masukkan Jenis Barang ...">
                                                </div>
                                                <div class="form-group">
                                                    <label>Feet</label>
                                                    <input type="number" value="{{$dataTransaction->feet}}" class="form-control" name="feet" placeholder="Masukkan Feet ...">
                                                </div>
                                                <div class="form-group">
                                                <label>Qty</label>
                                                    <input type="number" value="{{$dataTransaction->qty}}" class="form-control" name="qty" placeholder="Masukkan Qty ...">
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-user btn-block col-lg-4" name="update">
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