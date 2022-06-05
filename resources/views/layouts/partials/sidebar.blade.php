<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fw fa-money-bill"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Mari Menabung</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        @if(Auth::guard('user')->user())
        @if (Auth::guard('user')->user()->level == 'admin')
        <a class="nav-link" href="/admin">
            @elseif (Auth::guard('user')->user()->level == 'guru')
            <a class="nav-link" href="/guru">
                @endif
                @endif
                @if(Auth::guard('student')->user())
                <a class="nav-link" href="/siswa">
                    @endif

                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/berita">
            <i class="fas fw fa-newspaper"></i>
            <span>Berita</span></a>
    </li>


    {{-- Level User Admin --}}
    @if(Auth::guard('user')->user())
    @if(Auth::guard('user')->user()->level === "admin")
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Management
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-database"></i>
            <span>Pengelolaan Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admins.index') }}">Admin</a>
                <a class="collapse-item" href="{{ route('guru.index') }}">Guru</a>
                <a class="collapse-item" href="{{ route('murid.index') }}">Siswa</a>
                <a class="collapse-item" href="{{ route('tabungan.index') }}">Tabungan</a>
                <a class="collapse-item" href="{{ route('berita.index') }}">Berita</a>
                <a class="collapse-item" href="{{ route('kategori.index') }}">Kategori</a>
                <a class="collapse-item" href="{{ route('kelas.index') }}">Kelas</a>
                <a class="collapse-item" href="{{ route('metode.index') }}">Metode</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('saving.needverif') }}">
            <i class="fas fa-fw fa-clipboard-check"></i>
            <span>Verifikasi Tabungan</span></a>
    </li>
    @endif

    {{-- Untuk Guru --}}
    @if (Auth::guard('user')->user()->level === "guru")
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Management
    </div>

    <li class="nav-item">
        <a class="nav-link" href="/guru/input">
            <i class="fas fw fa-users"></i>
            <span>Daftar Siswa</span>
        </a>
    </li>
    @endif
    @endif

    {{-- Untuk Murid --}}
    @if (Auth::guard('student')->user())
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Tabungan
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('menabung') }}">
            <i class="fas fw fa-dollar-sign"></i>
            <span>Menabung</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('siswa.history') }}">
            <i class="far fw fa-hourglass"></i>
            <span>History</span></a>
    </li>

    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline mb-auto">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>