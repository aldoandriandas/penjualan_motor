@include('admin.layouts.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                @if (Auth::user()->role === 'admin')
                    <div class="sidebar-brand-text mx-3">Admin Motor</div>
                @else
                    <div class="sidebar-brand-text mx-3">Admin Sales</div>
                @endif
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            @php
                $role = Auth::user()->role;
            @endphp

            @if($role === 'super_admin' || $role === 'admin')

                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <hr class="sidebar-divider">

                <div class="sidebar-heading">
                    Menu Admin
                </div>

                <!-- USER -->
                <li class="nav-item">

                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
                        aria-expanded="true">

                        <i class="fas fa-users"></i>
                        <span>User</span>

                    </a>

                    <div id="collapseUser" class="collapse" data-parent="#accordionSidebar">

                        <div class="bg-white py-2 collapse-inner rounded">

                            <h6 class="collapse-header">Manajemen User</h6>

                            <a class="collapse-item" href="{{ route('admin.user.index') }}">
                                <i class="fas fa-user mr-2 text-primary"></i>

                                @if($role === 'admin')
                                    Kelola Pengguna
                                @else
                                    Lihat Pengguna
                                @endif

                            </a>

                        </div>
                    </div>

                </li>

            @endif





            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">

                    <i class="fas fa-box"></i>
                    <span>Produk</span>
                </a>

                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">

                    <div class="bg-white py-2 collapse-inner rounded">

                        <h6 class="collapse-header">Daftar Produk</h6>

                        <a class="collapse-item" href="{{ route('admin.motor.index') }}">
                            <i class="fas fa-motorcycle mr-2 text-primary"></i>
                            Motor
                        </a>

                        <a class="collapse-item" href="{{ route('admin.model.index') }}">
                            <i class="fas fa-cogs mr-2 text-success"></i>
                            Model Motor
                        </a>

                        <a class="collapse-item" href="{{ route('admin.merk.index') }}">
                            <i class="fas fa-tags mr-2 text-warning"></i>
                            Merk Motor
                        </a>

                        <a class="collapse-item" href="{{ route('admin.dealer.index') }}">
                            <i class="fas fa-ellipsis-h mr-2 text-secondary"></i>
                            Dealer
                        </a>
                        <a class="collapse-item" href="{{ route('admin.contact.index') }}">
                            <i class="fas fa-ellipsis-h mr-2 text-secondary"></i>
                            Message
                        </a>

                    </div>
                </div>
            </li>
            {{-- ================= MENU CICILAN ================= --}}
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCicilan"
                    aria-expanded="true" aria-controls="collapseCicilan">

                    <i class="fas fa-money-bill-wave"></i>
                    <span>Pembayaran</span>
                </a>

                <div id="collapseCicilan" class="collapse" aria-labelledby="headingCicilan"
                    data-parent="#accordionSidebar">

                    <div class="bg-white py-2 collapse-inner rounded">

                        <h6 class="collapse-header">Menu Pembayaran</h6>
                        <a class="collapse-item" href="#">
                            <i class="fas fa-history mr-2"></i>
                            Kas Pemasukan
                        </a>
                        <a class="collapse-item" href="#">
                            <i class="fas fa-history mr-2"></i>
                            Kas Pengeluaran
                        </a>

                        <a class="collapse-item" href="{{ route('admin.transaction.index') }}">
                            <i class="fas fa-file-invoice-dollar mr-2"></i>
                            Pembayaran
                        </a>


                    </div>
                </div>
            </li>
            {{-- ================= END MENU CICILAN ================= --}}





            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <div>
                        <h2 class="font-weight-bold text-dark">
                            Welcome,
                            <span class="text-primary">{{ auth()->user()->name }}</span> 👋
                        </h2>
                    </div>
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                            aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                        placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to
                                            download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All
                                    Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            @php
                                // Hitung pesan yang belum dibalas
                                $unreadCount = \App\Models\Contact::whereNull('reply')->count();

                                // Ambil 5 pesan terbaru yang belum dibalas
                                $latestMessages = \App\Models\Contact::whereNull('reply')
                                    ->orderBy('created_at', 'desc')
                                    ->take(5)
                                    ->get();
                            @endphp

                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>

                                {{-- Badge muncul hanya jika ada pesan baru --}}
                                @if($unreadCount > 0)
                                    <span class="badge badge-danger badge-counter">{{ $unreadCount }}</span>
                                @endif
                            </a>

                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">

                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>

                                @forelse($latestMessages as $message)
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ route('admin.contacts.show', $message->id) }}">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="{{ asset('sbadmin/img/undraw_profile_1.svg') }}" alt="...">
                                            <div class="status-indicator bg-success"></div> {{-- Semua pesan di sini belum
                                            dibalas --}}
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate">{{ Str::limit($message->message, 50) }}</div>
                                            <div class="small text-gray-500">{{ $message->name }} ·
                                                {{ $message->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="dropdown-item text-center small text-gray-500">
                                        Belum ada pesan baru
                                    </div>
                                @endforelse

                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('sbadmin/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="dropdown-item border-0 bg-transparent w-100 text-left text-danger"
                                        style="cursor:pointer;">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('admin.layouts.footer')