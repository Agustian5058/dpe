<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard.index')}}">
        <div class="sidebar-brand-text mx-3">{{getenv("app_name")}}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    @if (strtolower(session("role")) == "admin")
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Admin
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <i class="fas fa-fw fa-folder"></i>
                <span>Menu</span>
            </a>
            <div id="collapseOne" class="collapse <?php if (in_array(session('pagename'), ["Profil", "User", "Sales", "Customer", "Kapal", "Kedatangan Kapal", "Jenis Transaksi", "Transaksi Piutang"])) {echo 'show';} ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" aria-expanded="true">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu Utama</h6>
                    <a class="collapse-item <?php if (session('pagename') == 'Profil') {echo 'active';} ?>" href="{{route('profile.show', session('username'))}}">Profil</a>
                    <a class="collapse-item <?php if (session('pagename') == 'User') {echo 'active';} ?>" href="{{route('user.index')}}" >User</a>
                    <a class="collapse-item <?php if (session('pagename') == 'Sales') {echo 'active';} ?>" href="{{route('sales.index')}}">Sales</a>
                    <a class="collapse-item <?php if (session('pagename') == 'Customer') {echo 'active';} ?>" href="{{route('customer.index')}}">Customer</a>
                    <a class="collapse-item <?php if (session('pagename') == 'Kapal') {echo 'active';} ?>" href="{{route('vehicle.index')}}">Kapal</a>
                    <a class="collapse-item <?php if (session('pagename') == 'Jenis Transaksi') {echo 'active';} ?>" href="{{route('transaction_type.index')}}">Jenis Transaksi</a>
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Menu Tambahan</h6>
                    <a class="collapse-item <?php if (session('pagename') == 'Kedatangan Kapal') {echo 'active';} ?>" href="{{route('arrival.index')}}">Kedatangan Kapal</a>
                    <a class="collapse-item <?php if (session('pagename') == 'Transaksi Piutang') {echo 'active';} ?>" href="{{route('transaction.index')}}">Transaksi Piutang</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                <i class="fas fa-fw fa-folder"></i>
                <span>Laporan</span>
            </a>
            <div id="collapseThree" class="collapse  <?php if (in_array(session('pagename'), ["Laporan Customer", "Laporan Transaksi"])) {echo 'show';} ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Jenis Laporan</h6>
                    <a class="collapse-item <?php if (session('pagename') == 'Laporan Customer') {echo 'active';} ?>" href="{{route('laporan-customer.index')}}">Laporan Per User</a>
                    <a class="collapse-item <?php if (session('pagename') == 'Laporan Transaksi') {echo 'active';} ?>" href="{{route('laporan-transaksi.index')}}">Laporan Transaksi</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

    @endif

    @if (strtolower(session("role")) == "staff")

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Branch
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                <i class="fas fa-fw fa-folder"></i>
                <span>Main</span>
            </a>
            <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Main</h6>
                    <a class="collapse-item" href="#">Product</a>
                    <a class="collapse-item" href="#">Member</a>
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Addon</h6>

                    <a class="collapse-item" href="#">Product Stock</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                <i class="fas fa-fw fa-folder"></i>
                <span>Transaction</span>
            </a>
            <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Transaction</h6>
                    <a class="collapse-item" href="#">Transaction</a>
                    <a class="collapse-item" href="#"> Spending Transaction</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
    @endif

    @if (strtolower(session("role")) == "sales")
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Capster
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                <i class="fas fa-fw fa-folder"></i>
                <span>Report</span>
            </a>
            <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Report Detail:</h6>
                    <a class="collapse-item" href="#">Salary</a>
                    <a class="collapse-item" href="#">Transaction</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->