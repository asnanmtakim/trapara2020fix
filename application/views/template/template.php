<?php
$menu_active = $this->uri->segment(1);
$profile = $this->db->get_where('user', ['id_user' => $this->session->userdata('id')])->row();
$role = $this->session->userdata('role');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TRAPARA | <?= $title ?></title>
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/dist/img/psm.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bs-stepper/css/bs-stepper.min.css">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/dropzone/min/dropzone.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/toastr/toastr.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/magnific-popup/dist/magnific-popup.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/adminlte.min.css">
    <!-- jQuery -->
    <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- jquery-validation -->
    <script src="<?php echo base_url() ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jquery-validation/additional-methods.min.js"></script>
    <!-- Magnific Popup -->
    <script src="<?php echo base_url() ?>assets/plugins/magnific-popup/dist/jquery.magnific-popup.js"></script>
    <!-- bs-custom-file-input -->
    <script src="<?php echo base_url() ?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- date-range-picker -->
    <script src="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
    <style>
        .table>tbody>tr>td {
            vertical-align: middle;
        }

        .table>tbody>tr>th {
            vertical-align: middle;
            background-color: honeydew;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo base_url() ?>" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- SEARCH FORM -->
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <label class="form-control text-center form-control-navbar">
                            <span id="tanggal"></span>
                            <span id="jam"></span>
                        </label>
                    </div>
                </form>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                    <!-- </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li> -->
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?php echo base_url() ?>" class="brand-link">
                <img src="<?php echo base_url() ?>assets/dist/img/psm.png" alt="PSMUINSA Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">TRAPARA 2020</span>
            </a>
            <?php
            $foto = $profile->foto;
            $urlfoto = base_url('assets/uploads/foto_user/') . $foto;
            ?>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= $urlfoto; ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="<?= base_url() ?>profil" class="d-block"><?php echo $profile->nama_user; ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <?php
                    if ($role == 0) {
                    ?>
                        <ul class="nav nav-pills nav-sidebar flex-column nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-header">MENU UTAMA</li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>dashboard" class="nav-link <?php if ($menu_active == '' || $menu_active == 'dashboard') print 'active' ?>">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item <?php if ($menu_active == 'kelas' || $menu_active == 'admin' || $menu_active == 'peserta' || $menu_active == 'penjab' || $menu_active == 'pemateri') print 'menu-open' ?>">
                                <a href="#" class="nav-link <?php if ($menu_active == 'kelas' || $menu_active == 'admin' || $menu_active == 'peserta' || $menu_active == 'penjab' || $menu_active == 'pemateri') print 'active' ?>">
                                    <i class="nav-icon fas fa-folder-open"></i>
                                    <p>
                                        Data Master
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>admin" class="nav-link <?php if ($menu_active == 'admin') print 'active' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Admin</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    <?php
                    }
                    if ($role == 1) {
                    ?>
                        <ul class="nav nav-pills nav-sidebar flex-column nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-header">MENU UTAMA</li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>dashboard" class="nav-link <?php if ($menu_active == '' || $menu_active == 'dashboard') print 'active' ?>">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>profil" class="nav-link <?php if ($menu_active == 'profil') print 'active' ?>">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Profil Pengguna
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item <?php if ($menu_active == 'kelas' || $menu_active == 'admin' || $menu_active == 'peserta' || $menu_active == 'penjab' || $menu_active == 'pemateri') print 'menu-open' ?>">
                                <a href="#" class="nav-link <?php if ($menu_active == 'kelas' || $menu_active == 'admin' || $menu_active == 'peserta' || $menu_active == 'penjab' || $menu_active == 'pemateri') print 'active' ?>">
                                    <i class="nav-icon fas fa-folder-open"></i>
                                    <p>
                                        Data Master
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>kelas" class="nav-link <?php if ($menu_active == 'kelas') print 'active' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Kelas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>peserta" class="nav-link <?php if ($menu_active == 'peserta') print 'active' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Peserta</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>penjab" class="nav-link <?php if ($menu_active == 'penjab') print 'active' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Penanggung Jawab</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>pemateri" class="nav-link <?php if ($menu_active == 'pemateri') print 'active' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Pemateri</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>sebaran" class="nav-link <?php if ($menu_active == 'sebaran') print 'active' ?>">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>
                                        Sebaran Kelas
                                    </p>
                                </a>
                            </li>
                            <li class="nav-header">MATERI TRAPARA</li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>materi" class="nav-link <?php if ($menu_active == 'materi') print 'active' ?>">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Materi
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>jadwal" class="nav-link <?php if ($menu_active == 'jadwal') print 'active' ?>">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>
                                        Penjadwalan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-header">TUGAS TRAPARA</li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>tugas" class="nav-link <?php if ($menu_active == 'tugas') print 'active' ?>">
                                    <i class="nav-icon fas fa-tasks"></i>
                                    <p>
                                        Tugas
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>koreksi" class="nav-link <?php if ($menu_active == 'koreksi') print 'active' ?>">
                                    <i class="nav-icon fas fa-check-double"></i>
                                    <p>
                                        Pengkoreksian
                                    </p>
                                </a>
                            </li>
                            <li class="nav-header">ABSENSI TRAPARA</li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>absen" class="nav-link <?php if ($menu_active == 'absen') print 'active' ?>">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>
                                        Pembuatan Absen
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>absensi" class="nav-link <?php if ($menu_active == 'absensi') print 'active' ?>">
                                    <i class="nav-icon fas fa-paste"></i>
                                    <p>
                                        Absensi Peserta
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>lap_absensi" class="nav-link <?php if ($menu_active == 'lap_absensi') print 'active' ?>">
                                    <i class="nav-icon fas fa-folder-open"></i>
                                    <p>
                                        Laporan Absensi
                                    </p>
                                </a>
                            </li>
                        </ul>
                    <?php
                    } else if ($role == 2) {
                    ?>
                        <ul class="nav nav-pills nav-sidebar flex-column nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-header">MENU UTAMA</li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>dashboard" class="nav-link <?php if ($menu_active == '' || $menu_active == 'dashboard') print 'active' ?>">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>profil" class="nav-link <?php if ($menu_active == 'profil') print 'active' ?>">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Profil Pengguna
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>sebaran" class="nav-link <?php if ($menu_active == 'sebaran') print 'active' ?>">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>
                                        Sebaran Kelas
                                    </p>
                                </a>
                            </li>
                            <li class="nav-header">JADWAL DAN MATERI</li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>jadwal" class="nav-link <?php if ($menu_active == 'jadwal') print 'active' ?>">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>
                                        Jadwal Trapara
                                    </p>
                                </a>
                            </li>
                            <li class="nav-header">TUGAS PESERTA</li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>koreksi" class="nav-link <?php if ($menu_active == 'koreksi') print 'active' ?>">
                                    <i class="nav-icon fas fa-check-double"></i>
                                    <p>
                                        Tugas-tugas Peserta
                                    </p>
                                </a>
                            </li>
                            <li class="nav-header">ABSENSI TRAPARA</li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>absensi" class="nav-link <?php if ($menu_active == 'absensi') print 'active' ?>">
                                    <i class="nav-icon fas fa-paste"></i>
                                    <p>
                                        Absensi Peserta
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>lap_absensi" class="nav-link <?php if ($menu_active == 'lap_absensi') print 'active' ?>">
                                    <i class="nav-icon fas fa-folder-open"></i>
                                    <p>
                                        Laporan Absensi
                                    </p>
                                </a>
                            </li>
                        </ul>
                    <?php
                    } else if ($role == 3) {
                    ?>
                        <ul class="nav nav-pills nav-sidebar flex-column nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-header">MENU UTAMA</li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>dashboard" class="nav-link <?php if ($menu_active == '' || $menu_active == 'dashboard') print 'active' ?>">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>profil" class="nav-link <?php if ($menu_active == 'profil') print 'active' ?>">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Profil Pengguna
                                    </p>
                                </a>
                            </li>
                            <li class="nav-header">JADWAL DAN MATERI</li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>jadwal" class="nav-link <?php if ($menu_active == 'jadwal') print 'active' ?>">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>
                                        Jadwal dan Materi
                                    </p>
                                </a>
                            </li>
                            <li class="nav-header">TUGAS TRAPARA</li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>koreksi" class="nav-link <?php if ($menu_active == 'koreksi') print 'active' ?>">
                                    <i class="nav-icon fas fa-check-double"></i>
                                    <p>
                                        Koreksi & Nilai Tugas
                                    </p>
                                </a>
                            </li>
                        </ul>
                    <?php
                    } else if ($role == 4) {
                    ?>
                        <ul class="nav nav-pills nav-sidebar flex-column nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-header">MENU UTAMA</li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>dashboard" class="nav-link <?php if ($menu_active == '' || $menu_active == 'dashboard') print 'active' ?>">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>profil" class="nav-link <?php if ($menu_active == 'profil') print 'active' ?>">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Profil Pengguna
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>sebaran" class="nav-link <?php if ($menu_active == 'sebaran') print 'active' ?>">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>
                                        Sebaran Kelas
                                    </p>
                                </a>
                            </li>
                            <li class="nav-header">JADWAL DAN MATERI</li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>jadwal" class="nav-link <?php if ($menu_active == 'jadwal') print 'active' ?>">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>
                                        Jadwal dan Materi
                                    </p>
                                </a>
                            </li>
                            <li class="nav-header">TUGAS TRAPARA</li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>pengtugas" class="nav-link <?php if ($menu_active == 'pengtugas') print 'active' ?>">
                                    <i class="nav-icon fas fa-tasks"></i>
                                    <p>
                                        Tugas
                                    </p>
                                </a>
                            </li>
                        </ul>
                    <?php
                    }
                    ?>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->

            <div class="sidebar-custom">
                <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a>
                <a href="<?= base_url() ?>auth/logout" class="btn btn-warning hide-on-collapse pos-right">Logout</a>
            </div>
            <!-- /.sidebar-custom -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php echo $contents ?>
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; 2020 <a href="https://instagram.com/asnanmtakim" target="_blank">AsnanmTakim</a>.</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- jquery-validation -->
    <script src="<?php echo base_url() ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jquery-validation/additional-methods.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?php echo base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url() ?>assets/plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="<?php echo base_url() ?>assets/plugins/moment/moment.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- date-range-picker -->
    <script src="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?php echo base_url() ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- BS-Stepper -->
    <script src="<?php echo base_url() ?>assets/plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <!-- dropzonejs -->
    <script src="<?php echo base_url() ?>assets/plugins/dropzone/min/dropzone.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="<?php echo base_url() ?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url() ?>assets/plugins/toastr/toastr.min.js"></script>
    <!-- Magnific Popup -->
    <script src="<?php echo base_url() ?>assets/plugins/magnific-popup/dist/jquery.magnific-popup.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>
    <?php if ($this->session->flashdata('message_error')) { ?>
        <script>
            $(document).ready(function() {
                toastr.error("<?= $this->session->flashdata('message_error'); ?>")
            });
        </script>
    <?php } ?>
    <?php if ($this->session->flashdata('message_success')) { ?>
        <script>
            $(document).ready(function() {
                toastr.success("<?= $this->session->flashdata('message_success'); ?>")
            });
        </script>
    <?php } ?>
    <script language="JavaScript">
        var tanggallengkap = new String();
        var namahari = ("Min Sen Sel Rab Kam Jum Sab");
        namahari = namahari.split(" ");
        var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
        namabulan = namabulan.split(" ");
        var tgl = new Date();
        var hari = tgl.getDay();
        var tanggal = tgl.getDate();
        var bulan = tgl.getMonth();
        var tahun = tgl.getFullYear();
        tanggallengkap = namahari[hari] + ", " + tanggal + " " + namabulan[bulan] + " " + tahun + "";
        document.getElementById("tanggal").innerHTML = tanggallengkap;
    </script>
    <script type="text/javascript">
        window.setTimeout("waktu()", 1000);

        function waktu() {
            var tanggal = new Date();
            setTimeout("waktu()", 1000);
            document.getElementById("jam").innerHTML = tanggal.getHours() + ":" + tanggal.getMinutes() + ":" + tanggal.getSeconds() + " WIB";
        }
    </script>
</body>

</html>