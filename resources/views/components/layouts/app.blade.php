<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from bootstrapget.com/demos/clinix-healthcare-dashboard/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 20 Apr 2025 10:12:53 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PUSTU BRAGUNG</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:title" content="Admin Templates - Dashboard Templates">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg')}}">

    <!-- *************
		************ CSS Files *************
	  ************* -->
    <link rel="stylesheet" href="{{asset('assets/fonts/remix/remixicon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.min.css')}}">

    <!-- *************
		************ Vendor Css Files *************
	  ************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css')}}">

    <!-- Date Range CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/daterange/daterange.css')}}">

    @stack('css')
    @livewireStyles

</head>

<body>


    <!-- Page wrapper starts -->
    <div class="page-wrapper">

        <!-- Main container starts -->
        <div class="main-container">

            <!-- Sidebar wrapper starts -->
            <nav id="sidebar" class="sidebar-wrapper">

                <!-- Brand container starts -->
                <div class="brand-container d-flex align-items-center justify-content-between">

                    <!-- App brand starts -->
                    <div class="app-brand ms-3">
                        <a href="{{route('home')}}">
                            <img src="{{ asset('assets/images/logo.png')}}" class="logo" alt="pust">
                        </a>
                    </div>
                    <!-- App brand ends -->

                    <!-- Pin sidebar starts -->
                    <button type="button" class="pin-sidebar me-3">
                        <i class="ri-menu-line"></i>
                    </button>
                    <!-- Pin sidebar ends -->

                </div>
                <!-- Brand container ends -->

                <!-- Sidebar profile starts -->
                <div class="sidebar-profile">
                    <img 
                        src="{{ Auth::user()->foto ? asset('storage/'.Auth::user()->foto) : asset('assets/images/nofoto.jpg') }}" 
                        class="rounded-5" 
                        alt="Foto Profil">
                    
                    <h6 class="mb-1 profile-name text-nowrap text-truncate text-primary">
                        {{ Auth::user()->name }}
                    </h6>

                    <small class="profile-name text-nowrap text-truncate">
                        @if (Auth::user()->role == 'admin')
                            Admin
                        @elseif (Auth::user()->role == 'orang_tua')
                            Orang Tua
                        @elseif (Auth::user()->role == 'petugas')
                            Petugas
                        @endif
                    </small>
                </div>

                <!-- Sidebar profile ends -->

                <!-- Sidebar menu starts -->
                <div class="sidebarMenuScroll">
                    <ul class="sidebar-menu">
                        <li class="{{ request()->is('home') ? 'active current-page' : '' }}">
                            <a href="{{url('/home')}}" wire:navigate>
                                <i class="ri-hospital-line"></i>
                                <span class="menu-text">Pustu Dashboard</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('anak','posyandu*') ? 'active current-page' : '' }}">
                            <a href="{{url('/anak')}}" wire:navigate>
                                <i class="ri-group-2-line"></i>
                                <span class="menu-text">Data Anak</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('pemeriksaan') ? 'active current-page' : '' }}">
                            <a href="{{url('/pemeriksaan')}}" wire:navigate>
                                <i class="ri-heart-pulse-line"></i>
                                <span class="menu-text">Pemeriksaan</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('/pustu/grafik') ? 'active current-page' : '' }}">
                            <a href="{{url('/pustu/grafik')}}">
                                <i class="ri-bar-chart-line"></i>
                                <span class="menu-text">Grafik Perkembangan</span>
                            </a>
                        </li>
                        @if(in_array(Auth::user()->role, ['orang_tua']))
                            <li class="{{ request()->is('notifikasi') ? 'active current-page' : '' }}">
                                <a href="{{url('/notifikasi')}}">
                                    <i class="ri-news-line"></i>
                                    <span class="menu-text">Informasi</span>
                                </a>
                            </li>
                        @endif

                        <li class="{{ request()->is('konsultasi') ? 'active current-page' : '' }}">
                            <a href="{{url('konsultasi')}}">
                                <i class="ri-p2p-line"></i>
                                <span class="menu-text">Konsultasi</span>
                            </a>
                        </li>
                        @if(in_array(Auth::user()->role, ['admin']))
                            <li class="{{ request()->is('standar-pertumbuhan') ? 'active current-page' : '' }}">
                                <a href="{{url('standar-pertumbuhan')}}">
                                    <i class="ri-color-filter-line"></i>
                                    <span class="menu-text">Standart Pertumbuhan</span>
                                </a>
                            </li>
                        @endif

                        @if(in_array(Auth::user()->role, ['admin','petugas']))
                            <li class="{{ request()->is('jadwal') ? 'active current-page' : '' }}">
                                <a href="{{url('jadwal')}}">
                                    <i class="ri-calendar-line"></i>
                                    <span class="menu-text">Penjadwalan</span>
                                </a>
                            </li>
                        @endif


                        @if(in_array(Auth::user()->role, ['admin','petugas']))
                            <li class="{{ request()->is('users') ? 'active current-page' : '' }}">
                                <a href="{{url('users')}}">
                                    <i class="ri-color-filter-line"></i>
                                    <span class="menu-text">User</span>
                                </a>
                            </li>
                        @endif

                    </ul>
                </div>
                <!-- Sidebar menu ends -->

            </nav>
            <!-- Sidebar wrapper ends -->

            <!-- App container starts -->
            <div class="app-container">

                <!-- App header starts -->
                <div class="app-header d-flex align-items-center">

                    <!-- Brand container sm starts -->
                    <div class="brand-container-sm d-xl-none d-flex align-items-center">

                        <!-- App brand starts -->
                        <div class="app-brand">
                            <a href="{{route('home')}}">
                                <img src="{{ asset('assets/images/logo.png')}}" class="logo" alt="Medicare Admin Template">
                            </a>
                        </div>
                        <!-- App brand ends -->

                        <!-- Toggle sidebar starts -->
                        <button type="button" class="toggle-sidebar">
                            <i class="ri-menu-line"></i>
                        </button>
                        <!-- Toggle sidebar ends -->

                    </div>
                    <!-- Brand container sm ends -->

                    <!-- Search container starts -->
                    <div class="search-container d-xl-block d-none">
                        <input type="text" class="form-control" id="searchId" placeholder="Search">
                        <i class="ri-search-line"></i>
                    </div>
                    <!-- Search container ends -->

                    <!-- App header actions starts -->
                    <div class="header-actions">



                        <!-- Header user settings starts -->
                        <div class="dropdown ms-3">
                            <a id="userSettings" class="dropdown-toggle d-flex align-items-center" href="#!"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="avatar-box">
                                    <img src="{{ Auth::user()->foto ? asset('storage/'.Auth::user()->foto) : asset('assets/images/nofoto.jpg') }}" class="img-2xx rounded-5"
                                        alt="Medical Dashboard">
                                    <span class="status busy"></span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end shadow-lg">
                                <div class="px-3 py-2">
                                <span class="small">
                                    @if (Auth::user()->role == 'admin')
                                        Admin
                                    @elseif (Auth::user()->role == 'orang_tua')
                                        Orang Tua
                                    @elseif (Auth::user()->role == 'petugas')
                                        Petugas
                                    @endif
                                </span>

                                    <h6 class="m-0">{{Auth::user()->name}}</h6>
                                </div>
                                <div class="mx-3 my-2 d-grid">
                                    <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}"
                                        method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Header user settings ends -->

                    </div>
                    <!-- App header actions ends -->

                </div>
                <!-- App header ends -->

                <!-- App hero header starts -->

                <!-- App Hero header ends -->

                <!-- App body starts -->
                <div class="app-body">

                    <!-- Row starts -->
                    {{$slot}}
                    <!-- Row ends -->

                </div>
                <!-- App body ends -->

                <!-- App footer starts -->
                <div class="app-footer">
                    <span>© Pustu Desa Bragung 2025</span>
                </div>
                <!-- App footer ends -->

            </div>
            <!-- App container ends -->

        </div>
        <!-- Main container ends -->

    </div>
    <!-- Page wrapper ends -->

    <!-- *************
			************ JavaScript Files *************
		************* -->
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/js/moment.min.js')}}"></script>

    <!-- *************
			************ Vendor Js Files *************
		************* -->

    <!-- Overlay Scroll JS -->
    <script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/overlay-scroll/custom-scrollbar.js')}}"></script>

    <!-- Date Range JS -->
    <script src="{{ asset('assets/vendor/daterange/daterange.js')}}"></script>
    <script src="{{ asset('assets/vendor/daterange/custom-daterange.js')}}"></script>

    <!-- Apex Charts -->
    {{-- <script src="{{ asset('assets/vendor/apex/custom/dentist/patients.js')}}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/apex/custom/dentist/appointments.js')}}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/apex/custom/dentist/income.js')}}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/apex/custom/dentist/earnings.js')}}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/apex/custom/dentist/claims.js')}}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://unpkg.com/slim-select@latest/dist/slimselect.css" rel="stylesheet">
    </link>
    <script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>

    <!-- Custom JS files -->
    <script src="{{ asset('assets/js/custom.js')}}"></script>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('konfirmDelete', () => {
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Anda yakin ingin menghapus data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('delete');
                    }
                });
            });
        });

        document.addEventListener('livewire:init', () => {
            Livewire.on('HapusAja', () => {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil Dihapus'
                })
            });
        });

        window.addEventListener('gagalHapus', event => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: 'Data Berelasi dengan Tabel Lain'
            })

        });
    </script>
    @stack('js')
    @livewireScripts
</body>


<!-- Mirrored from bootstrapget.com/demos/clinix-healthcare-dashboard/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 20 Apr 2025 10:13:26 GMT -->

</html>