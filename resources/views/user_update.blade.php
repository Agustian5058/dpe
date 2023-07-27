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
                <h1 class="h3 mb-2 text-gray-800">Update User Data</h1>
                <button href="#" class="btn btn-primary" data-target="#ResetPasswordModal" data-toggle="modal">Reset Password</button>
                <div class="my-4"></div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-xl-15 col-lg-12 col-md-9">
                                <div class="card o-hidden border-0 shadow-lg my-1">
                                    <div class="card-body p-0">
                                        <div class="col-lg-15 p-5">
                                            <form action="{{route('user.update', $dataUser->username)}}" class="user" method="POST">
                                                @csrf
                                                @method('PUT')
                                                @if (session()->has("message"))
                                                <div class="alert alert-{{session('status')}}">
                                                    {{ session("message") }}
                                                </div>
                                                @endif
                                                <input type="hidden" value="{{$dataUser->username}}" name="username">
                                                <input type="hidden" value="Ready" name="password">
                                                <div class="form-group">
                                                    <input type="text" value="{{$dataUser->username}}" class="form-control" name="username" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" value="{{$dataUser->email}}" class="form-control" name="email" placeholder="Masukkan Email ...">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" value="{{$dataUser->name}}" class="form-control" name="name" placeholder="Masukkan Fullname ...">
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" name="role">
                                                        <option value="{{$dataUser->role}}">{{$dataUser->role}}</option>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Staff">Staff</option>
                                                        <option value="Sales">Sales</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" value="{{$dataUser->phone}}" class="form-control" name="phone" placeholder="Masukkan Phone Number ...">
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

                <!-- Create User Modal-->
                <div class="modal fade" id="ResetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah User Baru</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form class="user" method="POST" action="{{route('user.update', $dataUser->username)}}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{$dataUser->username}}" name="username">
                                <div class="modal-body">Apakah anda yakin untuk melakukan reset password user berikut
                                    <div class="my-4"></div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="username" value="{{$dataUser->username}}" disabled>
                                    </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                    <button class="btn btn-primary" type="submit">Reset Password</button>
                                </div>
                            </form>
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