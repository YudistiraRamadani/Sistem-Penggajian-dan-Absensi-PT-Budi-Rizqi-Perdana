<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT.BRP - Form Gaji</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        .alert-wrapper {
            position: fixed;
            top: 10%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }

        .alert {
            text-align: center;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SIP - PT.BRP</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item  ">
                <a class="nav-link" href="{{ route('admin.dataJabatan') }}">
                    <i class="fas fa-trophy"></i>
                    <span>Jabatan</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('admin.dataKaryawan') }}">
                    <i class="fas fa-users"></i>
                    <span>Karyawan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('admin.dataPK') }}">
                    <i class="fas fa-file-alt"></i>
                    <span>Data PK</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('admin.dataAbsensi') }}">
                    <i class="fas fa-user-clock"></i>
                    <span>Absensi</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dataKehadiran') }}">
                    <i class="fas fa-user-check"></i>
                    <span>Kehadiran</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.viewDataGaji') }}">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>Gaji</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

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

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @if (Session::has('success'))
                            <div class="alert-wrapper">
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            </div>
                        @endif

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('admin_assets/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Form Gaji</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <form action="{{ route('admin.storeGaji') }}" method="post">
                                @csrf
                                <input type="hidden" name="id_user" value="{{ $user->id }}">
                                <input type="hidden" name="total_masuk" value="{{ $total_masuk }}">
                                <input type="hidden" name="total_gaji" value="{{ $total_gaji }}">
                                <input type="hidden" name="tanggal_awal" value="{{ $tanggal_awal }}">
                                <input type="hidden" name="tanggal_akhir" value="{{ $tanggal_akhir }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama">Nama Karyawan</label>
                                            <input type="text" name="nama" id="nama" class="form-control"
                                                value="{{ $user->name }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                value="{{ $user->email }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_awal">Tanggal Awal</label>
                                            <input type="date" id="tanggal_awal" name="tanggal_awal"
                                                class="form-control" value="{{ $tanggal_awal }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jabatan">Jabatan</label>
                                            <input type="text" name="jabatan" id="jabatan" class="form-control"
                                                value="{{ $user->jabatan->nama_jabatan }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="total_masuk">Total Masuk</label>
                                            <input type="text" name="total_masuk" id="total_masuk"
                                                class="form-control" value="{{ $total_masuk }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_akhir">Tanggal Akhir</label>
                                            <input type="date" id="tanggal_akhir" name="tanggal_akhir"
                                                class="form-control" value="{{ $tanggal_akhir }}" readonly>
                                        </div>

                                        <div style="text-align: right;">
                                            <button type="submit" class="btn btn-success">Simpan Data Gaji</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                    <div class="card mt-4">
                        <div class="card-header">
                            Detail PK Selesai
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama PK</th>
                                        <th>Total PK Selesai</th>
                                        <th>Harga PK</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pkDetails as $pk)
                                        <tr>
                                            <td>{{ $pk->nama_pk }}</td>
                                            <td>{{ $pk->total_pk_selesai }}</td>
                                            <td>{{ $pk->harga_pk }}</td>
                                            <td>{{ $pk->total_pk_selesai * $pk->harga_pk }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-right">Total Gaji</th>
                                        <th>{{ $total_gaji }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert-wrapper').fadeOut('slow');
            }, 3000); // Menghilangkan alert setelah 3 detik (3000 ms)
        });
    </script>


</body>

</html>
