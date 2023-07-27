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
                <h1 class="h3 mb-2 text-gray-800">Update Customer Data</h1>
                <div class="my-4"></div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-xl-15 col-lg-12 col-md-9">
                                <div class="card o-hidden border-0 shadow-lg my-1">
                                    <div class="card-body p-0">
                                        <div class="col-lg-15 p-5">
                                            <form action="{{route('customer.update', $dataCustomer->customer_id)}}" class="user" method="POST">
                                                @csrf
                                                @method('PUT')
                                                @if (session()->has("message"))
                                                <div class="alert alert-{{session('status')}}">
                                                    {{ session("message") }}
                                                </div>
                                                @endif
                                                <input type="hidden" value="{{$dataCustomer->customer_id}}" name="customer_id">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$dataCustomer->customer_id}}" name="customer_id" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$dataCustomer->customer_name}}" name="customer_name" placeholder="Masukkan Nama Customer ...">
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" name="customer_sales">
                                                        <option value="{{$dataCustomer->customer_sales}}">{{$dataCustomer->customer_sales}}</option>
                                                        @foreach ($dataSaless as $dataSales)
                                                            <option value="{{$dataSales->sales_id}}">{{$dataSales->sales_id}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$dataCustomer->customer_phone}}" name="customer_phone" placeholder="Masukkan Nomor HP ...">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$dataCustomer->customer_address}}" name="customer_address" placeholder="Masukkan Alamat ...">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$dataCustomer->customer_province}}" name="customer_province" placeholder="Masukkan Provinsi ...">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$dataCustomer->customer_city}}" name="customer_city" placeholder="Masukkan Nama Kota ...">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$dataCustomer->customer_postal_code}}" name="customer_postal_code" placeholder="Masukkan Kode Pos ...">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$dataCustomer->customer_fax}}" name="customer_fax" placeholder="Masukkan Nomor Fax ...">
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