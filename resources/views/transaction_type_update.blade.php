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
                                            <form action="{{route('transaction_type.update', $dataTransactionType->transaction_name)}}" class="user" method="POST">
                                                @csrf
                                                @method('PUT')
                                                @if (session()->has("message"))
                                                <div class="alert alert-{{session('status')}}">
                                                    {{ session("message") }}
                                                </div>
                                                @endif
                                                <input type="hidden" value="{{$dataTransactionType->transaction_name}}" name="transaction_name">
                                                <div class="form-group">
                                                    <input type="text" value="{{$dataTransactionType->transaction_name}}" class="form-control" name="transaction_name" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" name="transaction_debit_credit">
                                                        <option value="{{$dataTransactionType->transaction_debit_credit}}">{{$dataTransactionType->transaction_debit_credit}}</option>
                                                        <option value="Debit">Debit</option>
                                                        <option value="Credit">Credit</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" value="{{$dataTransactionType->transaction_initial}}" class="form-control" name="transaction_initial" placeholder="Masukkan Inisial Transaksi ...">
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