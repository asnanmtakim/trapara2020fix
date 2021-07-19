<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Data Tugas</h1>
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
                        <h3 class="card-title">Detail Tugas</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="post">
                            <div class="user-block">
                                <span class="username" style="margin-left: 0;">
                                    <h5><strong><?= $one_tugas->judul_tugas ?></strong></h5>
                                </span>
                                <span class="description" style="margin-left: 0;">
                                    <h6>Batas Pengumpulan <strong><?= $one_tugas->batas_tgl ?></strong></h6>
                                </span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                <?= $one_tugas->deskripsi_tugas ?>
                            </p>
                        </div>
                        <?php
                        if ($status_pengtugas == 0) {
                        ?>
                            <div class="alert alert-danger alert-dismissible">
                                <h5><i class="icon fas fa-ban"></i> Belum Mengumpulkan!</h5>
                                Tugas Belum dikumpulkan! Silahkan upload tugas dibawah.
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="alert alert-success alert-dismissible">
                                <h5><i class="icon fas fa-check"></i> Sudah Mengumpulkan!</h5>
                                Tugas selesai dikumpulkan.
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Tanggal Pengumpulan</th>
                                        <td>: <?= date("d M Y H:i", $one_pengtugas['tgl_peng']) ?>
                                            <?php
                                            if ($one_pengtugas['tgl_peng'] > strtotime($one_tugas->batas_tgl)) {
                                                $status = [
                                                    'class' => 'badge-warning',
                                                    'value' => 'Telat'
                                                ];
                                            } else {
                                                $status = [
                                                    'class' => 'badge-success',
                                                    'value' => 'Tepat waktu'
                                                ];
                                            }
                                            ?>
                                            <span class="badge <?= $status['class'] ?>"><?= $status['value'] ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>File Tugas</th>
                                        <td class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Nama File</th>
                                                        <th>Ukuran</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?= $one_pengtugas['berkas_peng']['name'] ?></td>
                                                        <td><?= round((intval($one_pengtugas['berkas_peng']['size']) / 1024), 2) ?> kB</td>
                                                        <td class="text-left py-0 align-middle">
                                                            <a href="<?= site_url($one_pengtugas['berkas_peng']['server_path']) ?>" target="_blank" class="btn btn-sm btn-primary" title="Lihat"><i class="fas fa-eye"> Lihat</i></a>
                                                            <?php
                                                            if (time() < strtotime($one_tugas->batas_tgl)) {
                                                            ?>
                                                                <a href="javascript:hapus(<?= $one_pengtugas['id_pengtugas'] ?>)" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></a>
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nilai</th>
                                        <td>
                                            <h3><span class="badge badge-secondary"><?= $one_pengtugas['nilai'] ?></span></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Komentar/Catatan</th>
                                        <td>: <?= $one_pengtugas['komentar'] ?></td>
                                    </tr>
                                    <?php
                                    if ($one_pengtugas['berkas_revisi'] != '') {
                                    ?>
                                        <tr>
                                            <th>File Revisi</th>
                                            <td class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama File</th>
                                                            <th>Ukuran</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><?= $one_pengtugas['berkas_revisi']['name'] ?></td>
                                                            <td><?= round((intval($one_pengtugas['berkas_revisi']['size']) / 1024), 2) ?> kB</td>
                                                            <td class="text-left py-0 align-middle">
                                                                <a href="<?= site_url($one_pengtugas['berkas_revisi']['server_path']) ?>" target="_blank" class="btn btn-sm btn-primary" title="Lihat"><i class="fas fa-eye"> Lihat</i></a>
                                                                <a href="javascript:hapusrvs(<?= $one_pengtugas['id_pengtugas'] ?>)" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <?php
            if ($status_pengtugas == 0) {
            ?>
                <div class="col-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Upload Pengumpulan Tugas</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="id_tugas" id="id_tugas" value="<?= $one_tugas->id_tugas ?>">
                            <input type="hidden" name="id_peserta" id="id_peserta" value="<?= $id_peserta ?>">
                            <ul id="filelist"></ul>

                            <div id="container">
                                <button id="browse" class="btn btn-primary" href="javascript:;">[Browse...]</button>
                                <a id="start-upload" class="btn btn-warning" href="javascript:;">[Start Upload]</a>
                            </div>
                            <pre id="console"></pre>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <script src="<?= base_url(); ?>assets/plugins/plupload/js/plupload.full.min.js"></script>
                <script type="text/javascript">
                    var uploader = new plupload.Uploader({
                        browse_button: 'browse', // this can be an id of a DOM element or the DOM element itself
                        max_file_count: 1,
                        url: '<?= base_url() ?>pengtugas/uploadTugas',
                        chunk_size: '1mb',
                        max_retries: 3,
                        multipart_params: {
                            "id_tugas": $('#id_tugas').val(),
                            "id_peserta": $('#id_peserta').val()
                        }
                    });
                    uploader.bind('FilesAdded', function(up, files) {
                        var i = up.files.length,
                            maxCountError = false;
                        plupload.each(files, function(file) {
                            if (uploader.settings.max_file_count && i > uploader.settings.max_file_count) {
                                maxCountError = true;
                                setTimeout(function() {
                                    up.removeFile(file);
                                }, 50);
                            } else {
                                var html = '';
                                // $("#browse").prop('disabled', true);
                                plupload.each(files, function(file) {
                                    html += '<li id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></li>';
                                });
                                document.getElementById('filelist').innerHTML += html;
                            }
                            i++;
                        });
                        if (maxCountError) {
                            Swal.fire(
                                'Error!',
                                'File tidak boleh lebih dari 1.',
                                'error'
                            );
                        }
                    });
                    uploader.bind('UploadProgress', function(up, file) {
                        document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                    });
                    uploader.bind('Error', function(up, err) {
                        document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
                    });
                    document.getElementById('start-upload').onclick = function() {
                        uploader.start();
                    };
                    uploader.bind('FileUploaded', function() {
                        location.reload();
                    });
                    uploader.init();
                </script>
                <?php
            } else {
                if ($one_pengtugas['nilai'] != '' && $one_pengtugas['nilai'] < 70 && $one_pengtugas['berkas_revisi'] == '') {
                ?>
                    <div class="col-12">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Upload Revisi Tugas</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-warning alert-dismissible">
                                    <h5><i class="icon fas fa-ban"></i> Revisi Tugas!</h5>
                                    Nilai tugas anda dibawah rata-rata, Upload revisi tugas dibawah.
                                </div>
                                <input type="hidden" name="id_tugas" id="id_tugas" value="<?= $one_tugas->id_tugas ?>">
                                <input type="hidden" name="id_pengtugas" id="id_pengtugas" value="<?= $one_pengtugas['id_pengtugas'] ?>">
                                <ul id="filelist"></ul>

                                <div id="container">
                                    <button id="browse" class="btn btn-primary" href="javascript:;">[Browse...]</button>
                                    <a id="start-upload" class="btn btn-warning" href="javascript:;">[Start Upload]</a>
                                </div>
                                <pre id="console"></pre>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <script src="<?= base_url(); ?>assets/plugins/plupload/js/plupload.full.min.js"></script>
                    <script type="text/javascript">
                        var uploader = new plupload.Uploader({
                            browse_button: 'browse', // this can be an id of a DOM element or the DOM element itself
                            max_file_count: 1,
                            url: '<?= base_url() ?>pengtugas/uploadRevisi',
                            chunk_size: '1mb',
                            max_retries: 3,
                            multipart_params: {
                                "id_tugas": $('#id_tugas').val(),
                                "id_pengtugas": $('#id_pengtugas').val()
                            }
                        });
                        uploader.bind('FilesAdded', function(up, files) {
                            var i = up.files.length,
                                maxCountError = false;
                            plupload.each(files, function(file) {
                                if (uploader.settings.max_file_count && i > uploader.settings.max_file_count) {
                                    maxCountError = true;
                                    setTimeout(function() {
                                        up.removeFile(file);
                                    }, 50);
                                } else {
                                    var html = '';
                                    // $("#browse").prop('disabled', true);
                                    plupload.each(files, function(file) {
                                        html += '<li id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></li>';
                                    });
                                    document.getElementById('filelist').innerHTML += html;
                                }
                                i++;
                            });
                            if (maxCountError) {
                                Swal.fire(
                                    'Error!',
                                    'File tidak boleh lebih dari 1.',
                                    'error'
                                );
                            }
                        });
                        uploader.bind('UploadProgress', function(up, file) {
                            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                        });
                        uploader.bind('Error', function(up, err) {
                            document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
                        });
                        document.getElementById('start-upload').onclick = function() {
                            uploader.start();
                        };
                        uploader.bind('FileUploaded', function() {
                            location.reload();
                        });
                        uploader.init();
                    </script>
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>
<!-- /.content -->
<script>
    function hapus(id) {
        Swal.fire({
            title: 'Yakin hapus file?',
            text: "File yang sudah dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Terhapus!',
                    'File berhasil dihapus.',
                    'success'
                ).then((result) => {
                    location.href = "<?= base_url() ?>pengtugas/hapusTugas/" + id;
                });
            }
        });
    }

    function hapusrvs(id) {
        Swal.fire({
            title: 'Yakin hapus file?',
            text: "File yang sudah dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Terhapus!',
                    'File berhasil dihapus.',
                    'success'
                ).then((result) => {
                    location.href = "<?= base_url() ?>pengtugas/hapusRevisi/" + id;
                });
            }
        });
    }
    $(function() {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    });

    bsCustomFileInput.init();
</script>