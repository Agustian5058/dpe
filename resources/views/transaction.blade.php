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
                    <h1 class="h3 mb-2 text-gray-800">Data Transaksi</h1>
                    <button href="#" class="btn btn-primary" data-target="#CreateTransactionModal" data-toggle="modal">Tambah Transaksi Baru</button>
                    <div class="my-4"></div>
                    <!-- DataTales Example -->
                    @if (session()->has("message"))
                    <div class="alert alert-{{session('status')}}">
                        {{ session("message") }}
                    </div>
                    @endif
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Transaksi</th>
                                            <th>Kode Kedatangan</th>
                                            <th>Kapal</th>
                                            <th>Customer</th>
                                            <th>Transaksi</th>
                                            <th>Keterangan</th>
                                            <th>Harga</th>
                                            <th>Container</th>
                                            <th>Barang</th>
                                            <th>Feet</th>
                                            <th>Qty</th>
                                            <th>Debit / Kredit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Tanggal Transaksi</th>
                                            <th>Kode Kedatangan</th>
                                            <th>Kapal</th>
                                            <th>Customer</th>
                                            <th>Transaksi</th>
                                            <th>Keterangan</th>
                                            <th>Harga</th>
                                            <th>Container</th>
                                            <th>Barang</th>
                                            <th>Feet</th>
                                            <th>Qty</th>
                                            <th>Debit / Kredit</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @forelse ($dataTransactions as $dataTransaction)
                                            <tr>
                                                <td>{{ $dataTransaction->transaction_date }}</td>
                                                <td>{{ $dataTransaction->transaction_vehicle_arrival }}</td>
                                                <td>{{ $dataTransaction->vehicle_name }}</td>
                                                <td>{{ $dataTransaction->customer_name }} - {{ $dataTransaction->transaction_customer }}</td>
                                                <td>{{ $dataTransaction->transaction_transaction_type }}</td>
                                                <td>{{ $dataTransaction->note }}</td>
                                                <td>{{ $dataTransaction->price }}</td>
                                                <td>{{ $dataTransaction->transaction_container_number }}</td>
                                                <td>{{ $dataTransaction->goods_type }}</td>
                                                <td>{{ $dataTransaction->feet }}</td>
                                                <td>{{ $dataTransaction->qty }}</td>
                                                <td>{{ $dataTransaction->transaction_debit_credit }}</td>
                                                <td>
                                                    @if (session("role") == "Admin")
                                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('transaction.destroy', $dataTransaction->transaction_id) }}" method="POST">
                                                            <a href="{{route('transaction.edit', $dataTransaction->transaction_id)}}" class="user_update btn btn-warning">Ubah</a>        
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <div class="alert alert-danger">
                                                Data Transaksi belum Tersedia.
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
                <div class="modal fade" id="CreateTransactionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi Baru</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form class="user" method="POST" action="{{route('transaction.store')}}">
                                @csrf
                                <div class="modal-body">Masukkan Data Transaksi Baru.
                                    <div class="my-4"></div>
                                    <label>Kedatangan Kapal</label>
                                    <select class="form-control" name="arrival_id">
                                        @if (session()->has("dataArrival"))
                                            <option value="{{session('dataArrival')->arrival_id}}">{{session("dataArrival")->arrival_date}} {{session("dataArrival")->vehicle_id}} {{session("dataArrival")->vehicle_name}}</option>
                                        @else
                                            <option value="">-- Pilih Kedatangan Kapal --</option>
                                        @endif
                                        @foreach ($dataArrivals as $dataArrival)
                                            <option value="{{$dataArrival->arrival_id}}">{{$dataArrival->arrival_date}} {{$dataArrival->vehicle_id}} {{$dataArrival->vehicle_name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="my-4"></div>
                                        <label>Pilih Customer</label>
                                    <select class="form-control" name="customer_id">
                                        @if (session()->has("dataCustomer"))
                                            <option value="{{session('dataCustomer')->customer_id}}">{{session("dataCustomer")->customer_id}} {{session("dataCustomer")->customer_name}}</option>
                                        @else
                                            <option value="">-- Pilih Customer --</option>
                                        @endif
                                        @foreach ($dataCustomers as $dataCustomer)
                                            <option value="{{$dataCustomer->customer_id}}">{{$dataCustomer->customer_name}} {{$dataCustomer->customer_id}}</option>
                                        @endforeach
                                    </select>
                                    <div class="my-4"></div>
                                    <label>Jenis Transaksi</label>
                                    <select class="form-control" name="transaction_name">
                                        @if (session()->has("dataTransactionType"))
                                            <option value="{{session('dataTransactionType')->transaction_name}}">{{session("dataTransactionType")->transaction_debit_credit}} - {{session("dataTransactionType")->transaction_name}}</option>
                                        @else
                                            <option value="">-- Pilih Jenis Transaksi --</option>
                                        @endif
                                        @foreach ($dataTransactionTypes as $dataTransactionType)
                                            <option value="{{$dataTransactionType->transaction_name}}">{{$dataTransactionType->transaction_debit_credit}} - {{$dataTransactionType->transaction_name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="my-4"></div>
                                    <div class="form-group">
                                        <label>Keterangan Transaksi</label>
                                        <input type="text" class="form-control" name="note" placeholder="Masukkan Keterangan Transaksi ..." required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Container</label>
                                        <input type="text" class="form-control" name="transaction_container_number" placeholder="Masukkan Nomor Container ...">
                                    </div>
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="number" class="form-control" name="price" placeholder="Masukkan Harga ..." required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Barang</label>
                                        <input type="text" class="form-control" name="goods_type" placeholder="Masukkan Jenis Barang ...">
                                    </div>
                                    <div class="form-group">
                                        <label>Feet</label>
                                        <input type="number" class="form-control" name="feet" placeholder="Masukkan Feet ...">
                                    </div>
                                    <div class="form-group">
                                        <label>Qty</label>
                                        <input type="number" class="form-control" name="qty" placeholder="Masukkan Qty ...">
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