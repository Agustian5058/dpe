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
                <h1 class="h3 mb-2 text-gray-800">Profile Data</h1>

                <button href="#" class="btn btn-primary" data-target="#ChangePasswordModal" data-toggle="modal">Change Password</button>
                <div class="my-4"></div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-xl-15 col-lg-12 col-md-9">
                                <div class="card o-hidden border-0 shadow-lg my-1">
                                    <div class="card-body p-0">
                                        <div class="col-lg-15 p-5">
                                            <form action="{{route('profile.update', $profile->username)}}" class="user" method="POST">
                                                @csrf
                                                @method('PUT')
                                                @if (session()->has("message"))
                                                <div class="alert alert-{{session('status')}}">
                                                    {{ session("message") }}
                                                </div>
                                                @endif
                                                <input type="hidden" value="{{$profile->username}}" name="username">
                                                <input type="hidden" value="Ready" name="password">
                                                <div class="form-group">
                                                    <input type="text" value="{{$profile->username}}" class="form-control" name="username" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" value="{{$profile->email}}" class="form-control" name="email" placeholder="Masukkan Email ...">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" value="{{$profile->name}}" class="form-control" name="name" placeholder="Masukkan Fullname ...">
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" name="role">
                                                        <option value="{{$profile->role}}">{{$profile->role}}</option>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Staff">Staff</option>
                                                        <option value="Sales">Sales</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" value="{{$profile->phone}}" class="form-control" name="phone" placeholder="Masukkan Phone Number ...">
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

                <!-- Create Branch Modal-->
                <div class="modal fade" id="ChangePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form class="user" method="POST" action="{{route('profile.store')}}">
                                @csrf
                                <div class="modal-body">Input New Password.
                                    <div class="my-4"></div>
                                    <input type="hidden" name="action" value="password_update">
                                    <input type="hidden" name="username" value="{{$profile->username}}">
                                    <div class="form-group">
                                        <label>Password Sekarang</label>
                                        <input type="password" class="form-control" name="current_password" placeholder="Masukkan Password Sekarang ...">
                                    </div>
                                    <div class="form-group">
                                        <label>Password Baru</label>
                                        <input type="password" class="form-control" name="new_password" placeholder="Masukkan Password Baru ...">
                                    </div>
                                    <div class="form-group">
                                        <label>Masukkan Kembali Password Baru</label>
                                        <input type="password" class="form-control" name="confirmation_password" placeholder="Masukkan Ulang Password Baru ...">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary" type="submit">Change</button>
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