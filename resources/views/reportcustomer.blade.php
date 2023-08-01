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
                    <button href="#" class="btn btn-primary" data-target="#FilterTransactionModal" data-toggle="modal">Filter Transaksi</button>
                    <div class="my-4"></div>
                    <a href="{{route('laporan-customer.export-excel')}}" class="btn btn-primary">Export Excel</a>
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
                                @include('reportcustomer_table', $dataCustomers)
                            </div>
                        </div>
                    </div>

                    <!-- Create User Modal-->
                    <div class="modal fade" id="FilterTransactionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Masukkan Filter Transaksi</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form class="user" method="POST" action="{{route('laporan-transaksi.store')}}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="my-4"></div>
                                        <div class="form-group">
                                            <label>Dari Tanggal</label>
                                            <input type="date" class="form-control" name="from_date" @if (session()->has("from_date")) value="{{session("from_date")}}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label>Sampai Tanggal</label>
                                            <input type="date" class="form-control" name="to_date">
                                        </div>
                                        <div class="my-4"></div>
                                        <label>Sales</label>
                                        <select class="form-control" name="sales_id">
                                            @if (session()->has("dataSales"))
                                                <option value="{{session('dataSales')->sales_id}}">{{session("dataSales")->sales_id}} - {{session("dataSales")->sales_name}}</option>
                                            @else
                                                <option value="">-- Pilih Sales --</option>
                                            @endif
                                            @foreach ($dataSaless as $dataSales)
                                                <option value="{{$dataSales->sales_id}}">{{$dataSales->sales_id}} - {{$dataSales->sales_name}}</option>
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
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                        <button class="btn btn-primary" type="submit">Cari</button>
                                    </div>
                                </form>
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