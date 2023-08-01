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
                    <h1 class="h3 mb-2 text-gray-800">Data User</h1>
                    <button href="#" class="btn btn-primary" data-target="#CreateUserModal" data-toggle="modal">Tambah User Baru</button>
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
                                            <th></th>
                                            <th>Username</th>
                                            <th>Nama User</th>
                                            <th>Role</th>
                                            <th>Email</th>
                                            <th>Nomor HP</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Username</th>
                                            <th>Nama User</th>
                                            <th>Role</th>
                                            <th>Email</th>
                                            <th>Nomor HP</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @forelse ($dataUsers as $dataUser)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $dataUser->username }}</td>
                                                <td>{{ $dataUser->name }}</td>
                                                <td>{{ $dataUser->role }}</td>
                                                <td>{{ $dataUser->email }}</td>
                                                <td>{{ $dataUser->phone }}</td>
                                                <td>
                                                    @if ($dataUser->role != "Admin")
                                                        <a href="{{route('user.edit', $dataUser->username)}}" class="user_update btn btn-warning">Ubah</a>
                                                        <a href="#" class="user_update btn btn-danger" data-target="#ResetPasswordModal" data-toggle="modal">Reset Password</a>
                                                        <!-- <a href="{{route('user.destroy', $dataUser->username)}}" class="user_update btn btn-danger">Hapus</a> -->
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <div class="alert alert-danger">
                                                Data User belum Tersedia.
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
                <div class="modal fade" id="CreateUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah User Baru</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form class="user" method="POST" action="{{route('user.store')}}">
                                @csrf
                                <div class="modal-body">Masukkan Data User Baru. Username tidak boleh sama.
                                    <div class="my-4"></div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username" placeholder="Masukkan Username ...">
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Lengkap ...">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Masukkan Email ...">
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor HP</label>
                                        <input type="text" class="form-control" name="phone" placeholder="Masukkan Nomor HP ...">
                                    </div>
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="form-control" name="role">
                                            <option value="Staff">-- Pilih Role (Staff)--</option>
                                            <option value="Staff">Staff</option>
                                            <option value="Sales">Sales</option>
                                            <option value="Admin">Admin</option>
                                        </select>
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
            

                <!-- Create User Modal-->
                <div class="modal fade" id="ResetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Reset Password User</h5>
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
                                        <label>Username</label>
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