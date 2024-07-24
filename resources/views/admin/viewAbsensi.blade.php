<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT.BRP - Absensi</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

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
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.dataAbsensi') }}">
                    <i class="fas fa-user-clock"></i>
                    <span>Absensi</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dataKehadiran') }}">
                    <i class="fas fa-user-check"></i>
                    <span>Kehadiran</span></a>
            </li>
            <li class="nav-item">
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
                        <h1 class="h3 mb-0 text-gray-800">Data Absensi</h1>
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahDataModal">Tambah
                            Data</button>


                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Pulang</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($absensi as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->judul_absensi }}</td>
                                                <td>{{ $item->deskripsi_absensi }}</td>
                                                <td>{{ $item->jam_masuk }}</td>
                                                <td>{{ $item->jam_pulang }}</td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-warning"
                                                        data-toggle="modal"
                                                        data-target="#modalEdit{{ $item->id_absensi }}">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#modalHapus{{ $item->id_absensi }}">
                                                        Hapus
                                                    </button>

                                                    <!-- Modal Edit -->
                                                    <div class="modal fade" id="modalEdit{{ $item->id_absensi }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Edit Data PK</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form method="POST"
                                                                    action="{{ route('admin.editAbsensi', $item->id_absensi) }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label>Judul Absensi</label>
                                                                            <input name="judul_absensi" type="text"
                                                                                class="form-control"
                                                                                value="{{ $item->judul_absensi }}"
                                                                                required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Deksripsi Absensi</label>
                                                                            <textarea name="deskripsi_absensi" type="text" class="form-control" required>{{ $item->deskripsi_absensi }}</textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Jam Masuk</label>
                                                                            <input name="jam_masuk" type="time"
                                                                                class="form-control"
                                                                                value="{{ $item->jam_masuk }}"
                                                                                required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Batas Jam Masuk</label>
                                                                            <input name="batas_jam_masuk"
                                                                                type="time" class="form-control"
                                                                                value="{{ $item->batas_jam_masuk }}"
                                                                                required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Jam Pulang</label>
                                                                            <input name="jam_pulang" type="time"
                                                                                class="form-control"
                                                                                value="{{ $item->jam_pulang }}"
                                                                                required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Batas Jam Pulang</label>
                                                                            <input name="batas_jam_pulang"
                                                                                type="time" class="form-control"
                                                                                value="{{ $item->batas_jam_pulang }}"
                                                                                required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save
                                                                            changes</button>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!-- Modal Hapus -->
                                                    <div class="modal fade" id="modalHapus{{ $item->id_absensi }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form method="POST"
                                                                    action="{{ route('admin.hapusAbsensi') }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <input type="hidden" name="id_absensi"
                                                                        value="{{ $item->id_absensi }}">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLabel">
                                                                            Hapus Data Absensi</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Apakah anda yakin menghapus data
                                                                        {{ $item->judul_absensi }}?

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Delete</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('admin.tambahAbsensi') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="judul">Judul Absensi</label>
                            <input type="text" name="judul" id="judul" class="form-control"
                                placeholder="Masukkan judul" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Absensi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Masukkan deskripsi" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="jam_masuk">Jam Masuk</label>
                            <input type="time" name="jam_masuk" id="jam_masuk" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="batas_jam_masuk">Batas Jam Masuk</label>
                            <input type="time" name="batas_jam_masuk" id="batas_jam_masuk" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="jam_keluar">Jam Keluar</label>
                            <input type="time" name="jam_pulang" id="jam_keluar" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="batas_jam_keluar">Batas Jam Keluar</label>
                            <input type="time" name="batas_jam_pulang" id="batas_jam_keluar" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


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

    <!-- Page level plugins -->
    <script src="{{ asset('admin_assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('admin_assets/js/demo/datatables-demo.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#tambahDataModal').on('hidden.bs.modal', function() {
                $(this).find('form').trigger('reset');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert-wrapper').fadeOut('slow');
            }, 3000); // Menghilangkan alert setelah 3 detik (3000 ms)
        });
    </script>


</body>

</html>
