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
                    <h1 class="h3 mb-2 text-gray-800">Data Tipe Transaction</h1>
                    <button href="#" class="btn btn-primary" data-target="#CreateTransactionTypeModal" data-toggle="modal">Tambah Jenis Transaction Baru</button>
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
                                            <th>Nama Transaksi</th>
                                            <th>Debit / Kredit</th>
                                            <th>Inisial Transaksi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>Nama Transaksi</th>
                                            <th>Debit / Kredit</th>
                                            <th>Inisial Transaksi</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @forelse ($dataTransactionTypes as $dataTransactionType)
                                            <tr>
                                                <td>{{ $dataTransactionType->transaction_name }}</td>
                                                <td>{{ $dataTransactionType->transaction_debit_credit }}</td>
                                                <td>{{ $dataTransactionType->transaction_initial }}</td>
                                                <td>
                                                    @if (session("role") == "Admin")
                                                        <a href="{{route('transaction_type.edit', $dataTransactionType->transaction_name)}}" class="user_update btn btn-warning">Ubah</a>
                                                        <!-- <a href="{{route('transaction_type.destroy', $dataTransactionType->transaction_name)}}" class="user_update btn btn-danger">Hapus</a> -->
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <div class="alert alert-danger">
                                                Data Jenis Transaksi belum Tersedia.
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
                <div class="modal fade" id="CreateTransactionTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Transaction Baru</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form class="user" method="POST" action="{{route('transaction_type.store')}}">
                                @csrf
                                <div class="modal-body">Masukkan Data Jenis Transaction Baru. Nama Transaction tidak boleh sama.
                                    <div class="my-4"></div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="transaction_name" placeholder="Masukkan Nama Transaksi ...">
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="transaction_debit_credit">
                                            <option value="Debit">-- Debit / Kredit (Debit)--</option>
                                            <option value="Debit">Debit</option>
                                            <option value="Credit">Kredit</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="transaction_initial" placeholder="Masukkan Inisial Transaksi ...">
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