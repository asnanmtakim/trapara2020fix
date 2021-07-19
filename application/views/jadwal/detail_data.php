<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Jadwal Trapara</h1>
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
                        <h3 class="card-title">Detail Jadwal Trapara 2020</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Pemateri 1</th>
                                            <td><?= $pemateri->nama_user ?></td>
                                            <td></td>
                                            <td>
                                                <a href="<?= (site_url('assets/uploads/foto_user/' . $pemateri->foto)); ?>" class="image-link">
                                                    <img src="<?= (site_url('assets/uploads/foto_user/' . $pemateri->foto)); ?>" alt="" style="width:30px;height:30px">
                                                </a>
                                            </td>
                                            <td class="float-right">
                                                Link Kelas: <a href="<?= $kelas->link_kelas ?>" target="_blank" title="Link Kelas" class="btn btn-sm btn-info"><?= $kelas->link_kelas ?></a>
                                            </td>
                                        </tr>
                                        <?php
                                        if ($pemateri2 != null) {
                                        ?>
                                            <tr>
                                                <th>Pemateri 2</th>
                                                <td><?= $pemateri2->nama_user ?></td>
                                                <td></td>
                                                <td>
                                                    <a href="<?= (site_url('assets/uploads/foto_user/' . $pemateri2->foto)); ?>" class="image-link">
                                                        <img src="<?= (site_url('assets/uploads/foto_user/' . $pemateri2->foto)); ?>" alt="" style="width:30px;height:30px">
                                                    </a>
                                                </td>
                                                <td class="float-right">
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        <tr>
                                            <th>Kelas</th>
                                            <td colspan="4"><?= $kelas->nama_kelas ?></td>
                                        </tr>
                                        <tr>
                                            <th>Materi</th>
                                            <td colspan="4">
                                                <div class="post" style="color: black;">
                                                    <div class="user-block">
                                                        <span class="username" style="margin-left: 0;">
                                                            <h5><strong><?= $materi->judul_materi ?></strong></h5>
                                                        </span>
                                                        <span class="description" style="margin-left: 0;">
                                                            <h6><?= $materi->tgl_materi ?></h6>
                                                        </span>
                                                    </div>
                                                    <!-- /.user-block -->
                                                    <p>
                                                        <?= $materi->deskripsi_materi ?>
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Berkas</th>
                                            <td colspan="4">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Nama File</th>
                                                                <th>Ukuran</th>
                                                                <th>/</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="berkasmateri">
                                                            <?php
                                                            if (isset($berkas)) {
                                                                foreach ($berkas as $bks) {
                                                            ?>
                                                                    <tr>
                                                                        <td><?= $bks['berkas_materi'] ?></td>
                                                                        <td><?= round((intval($bks['info_berkas']['size']) / 1024), 2) ?> kB</td>
                                                                        <td class="text-left py-0 align-middle">
                                                                            <a href="<?= site_url($bks['info_berkas']['server_path']) ?>" target="_blank" class="btn btn-sm btn-info" title="Lihat"><i class="fas fa-eye"> Lihat / Unduh</i></a>
                                                                        </td>
                                                                    </tr>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
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
    });

    // let url = <?= base_url() ?> + "materi/loadMateri";
    // let id = $('#id_materi').val();
    // $.ajax({
    //     type: "POST",
    //     dataType: "html",
    //     url: url,
    //     data: "id=" + id,
    //     success: function(msg) {
    //         $("#berkasmateri").html(msg);
    //     }
    // });

    bsCustomFileInput.init();
</script>