<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Koreksi Tugas Peserta Trapara</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Detail Tugas Peserta Trapara 2020</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th>Pengkoreksi 1</th>
                                    <td><?= $pemateri->nama_user ?></td>
                                    <td>
                                        <a href="<?= (site_url('assets/uploads/foto_user/' . $pemateri->foto)); ?>" class="image-link">
                                            <img src="<?= (site_url('assets/uploads/foto_user/' . $pemateri->foto)); ?>" alt="" style="width:30px;height:30px">
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                if ($pemateri2 != null) {
                                ?>
                                    <tr>
                                        <th>Pengkoreksi 2</th>
                                        <td><?= $pemateri2->nama_user ?></td>
                                        <td>
                                            <a href="<?= (site_url('assets/uploads/foto_user/' . $pemateri2->foto)); ?>" class="image-link">
                                                <img src="<?= (site_url('assets/uploads/foto_user/' . $pemateri2->foto)); ?>" alt="" style="width:30px;height:30px">
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <th>Kelas</th>
                                    <td colspan="2"><?= $kelas->nama_kelas ?></td>
                                </tr>
                                <tr>
                                    <th>Tugas</th>
                                    <td colspan="2">
                                        <div class="post">
                                            <div class="user-block">
                                                <span class="username" style="margin-left: 0;">
                                                    <h5><strong><?= $tugas->judul_tugas ?></strong></h5>
                                                </span>
                                                <span class="description" style="margin-left: 0;">
                                                    <h6>Batas Pengumpulan <strong><?= $tugas->batas_tgl ?></strong></h6>
                                                </span>
                                            </div>
                                            <!-- /.user-block -->
                                            <p>
                                                <?= $tugas->deskripsi_tugas ?>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">File Tugas Peserta Trapara</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peserta</th>
                                        <th>Suara</th>
                                        <th>Tgl Pengumpulan</th>
                                        <th>File Tugas</th>
                                        <th>Nilai</th>
                                        <?php
                                        if ($this->session->userdata('role') != 2) {
                                            echo '<th>Aksi</th>';
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($pengtugas)) {
                                        $no = 0;
                                        foreach ($pengtugas as $ptgs) {
                                    ?>
                                            <tr>
                                                <td><?= ++$no; ?></td>
                                                <td><?= $ptgs->nama_user ?></td>
                                                <td><?= $ptgs->suara ?></td>
                                                <td><?= date("d M Y H:i", $ptgs->tgl_peng) ?></td>
                                                <td>
                                                    <a href="<?= base_url() ?>assets/uploads/tugas/<?= $ptgs->id_tugas ?>/<?= $ptgs->berkas_peng ?>" target="_blank">
                                                        <h5><span class="badge badge-warning"><?= $ptgs->berkas_peng ?></span></h5>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($ptgs->nilai == '') {
                                                    ?>
                                                        <h5><span class="badge badge-warning">Belum dinilai</span></h5>
                                                    <?php
                                                    } else {
                                                        print $ptgs->nilai;
                                                    }
                                                    ?>
                                                </td>
                                                <?php
                                                if ($this->session->userdata('role') != 2) {
                                                    echo '<td>';
                                                    echo anchor(site_url('koreksi/nilai/' . $ptgs->id_pengtugas . '/' . $id_koreksi), '<i class="fas fa-star"></i> Beri nilai', array('title' => 'Nilai Tugas', 'class' => 'btn btn-success'));
                                                    echo '</td>';
                                                }
                                                ?>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<script>
    $(function() {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        $('.image-link').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            fixedContentPos: true,
            image: {
                verticalFit: true
            },
            zoom: {
                enabled: true,
                duration: 300 // don't foget to change the duration also in CSS
            },
        });
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('.image-link').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            fixedContentPos: true,
            image: {
                verticalFit: true
            },
            zoom: {
                enabled: true,
                duration: 300 // don't foget to change the duration also in CSS
            },
        });
    });

    bsCustomFileInput.init();
</script>