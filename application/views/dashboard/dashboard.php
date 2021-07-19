<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Dashboard TRAPARA 2020</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-widget widget-user shadow">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username">Selamat Datang </h3>
                        <h5 class="widget-user-desc">Training Paduan Suara 2020</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="<?= base_url() ?>assets/dist/img/psm.png" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="description-block">
                                    <h5 class="description-header">Jl Wonocolo Pabrik Kulit 69 Surabaya</h5>
                                    <span class="description-text">Telp. 082334282708</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
        </div>
        <?php
        if ($this->session->userdata('role') == 4) {
        ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Absensi Peserta Trapara 2020</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Peserta</th>
                                            <th>NIM</th>
                                            <th>Kelas</th>
                                            <th>Hadir</th>
                                            <th>Izin</th>
                                            <th>Tidak Hadir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= $lap_absensi['peserta']->nama_user ?></td>
                                            <td><?= $lap_absensi['peserta']->nim ?></td>
                                            <td><?= $lap_absensi['peserta']->nama_kelas ?></td>
                                            <td><?= $lap_absensi['masuk'] ?></td>
                                            <td><?= $lap_absensi['izin'] ?></td>
                                            <td><?= $lap_absensi['alfa'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>
<!-- /.content -->