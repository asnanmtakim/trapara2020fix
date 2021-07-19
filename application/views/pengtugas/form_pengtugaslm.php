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
                            <div id="actions" class="row">
                                <div class="col-lg-5">
                                    <div class="btn-group w-100">
                                        <span class="btn btn-success col fileinput-button">
                                            <i class="fas fa-plus"></i>
                                            <span>Add files</span>
                                        </span>
                                        <button type="submit" class="btn btn-primary col start">
                                            <i class="fas fa-upload"></i>
                                            <span>Start upload</span>
                                        </button>
                                        <button type="reset" class="btn btn-warning col cancel">
                                            <i class="fas fa-times-circle"></i>
                                            <span>Cancel upload</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-7 d-flex align-items-center">
                                    <div class="fileupload-process w-100">
                                        <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table table-striped files" id="previews">
                                <div id="template" class="row mt-2">
                                    <div class="col-auto">
                                        <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                                    </div>
                                    <div class="col d-flex align-items-center">
                                        <p class="mb-0">
                                            <span class="lead" data-dz-name></span>
                                            (<span data-dz-size></span>)
                                        </p>
                                        <strong class="error text-danger" data-dz-errormessage></strong>
                                    </div>
                                    <div class="col-4 d-flex align-items-center">
                                        <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                        </div>
                                    </div>
                                    <div class="col-auto d-flex align-items-center">
                                        <div class="btn-group">
                                            <button class="btn btn-primary start">
                                                <i class="fas fa-upload"></i>
                                                <span>Start</span>
                                            </button>
                                            <button data-dz-remove class="btn btn-warning cancel">
                                                <i class="fas fa-times-circle"></i>
                                                <span>Cancel</span>
                                            </button>
                                            <button data-dz-remove class="btn btn-danger delete">
                                                <i class="fas fa-trash"></i>
                                                <span>Delete</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <script>
                    $(function() {
                        // DropzoneJS Demo Code Start
                        Dropzone.autoDiscover = false;

                        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
                        var previewNode = document.querySelector("#template");
                        previewNode.id = "";
                        var previewTemplate = previewNode.parentNode.innerHTML;
                        previewNode.parentNode.removeChild(previewNode);

                        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
                            url: "<?= base_url('pengtugas/uploadTugas') ?>", // Set the url
                            method: "post",
                            paramName: "berkas_peng",
                            maxFiles: 1,
                            method: "post",
                            timeout: 180000,
                            parallelUploads: 1,
                            thumbnailWidth: 80,
                            thumbnailHeight: 80,
                            previewTemplate: previewTemplate,
                            init: function() {
                                // Set up any event handlers
                                this.on('queuecomplete', function() {
                                    location.reload();
                                });
                                this.on("maxfilesexceeded", function(file) {
                                    Swal.fire(
                                        'Error!',
                                        'File tidak boleh lebih dari 1.',
                                        'error'
                                    )
                                });
                            },
                            autoQueue: false, // Make sure the files aren't queued until manually added
                            previewsContainer: "#previews", // Define the container to display the previews
                            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
                        });

                        myDropzone.on("addedfile", function(file) {
                            // Hookup the start button
                            file.previewElement.querySelector(".start").onclick = function() {
                                myDropzone.enqueueFile(file);
                            };
                        });

                        // Update the total progress bar
                        myDropzone.on("totaluploadprogress", function(progress) {
                            document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
                        });

                        myDropzone.on("sending", function(file, xhr, formData) {
                            // Show the total progress bar when upload starts
                            document.querySelector("#total-progress").style.opacity = "1";
                            // And disable the start button
                            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
                            var id_tugas = $('#id_tugas').val();
                            var id_peserta = "<?= $id_peserta ?>";
                            formData.append('id_tugas', id_tugas);
                            formData.append('id_peserta', id_peserta);
                        });

                        // Hide the total progress bar when nothing's uploading anymore
                        myDropzone.on("queuecomplete", function(progress) {
                            document.querySelector("#total-progress").style.opacity = "0";
                        });
                        // Setup the buttons for all transfers
                        // The "add files" button doesn't need to be setup because the config
                        // `clickable` has already been specified.
                        document.querySelector("#actions .start").onclick = function() {
                            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
                        };
                        document.querySelector("#actions .cancel").onclick = function() {
                            myDropzone.removeAllFiles(true);
                        };
                        // DropzoneJS Demo Code End
                    });
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
                                <div id="actions" class="row">
                                    <div class="col-lg-5">
                                        <div class="btn-group w-100">
                                            <span class="btn btn-success col fileinput-button">
                                                <i class="fas fa-plus"></i>
                                                <span>Add files</span>
                                            </span>
                                            <button type="submit" class="btn btn-primary col start">
                                                <i class="fas fa-upload"></i>
                                                <span>Start upload</span>
                                            </button>
                                            <button type="reset" class="btn btn-warning col cancel">
                                                <i class="fas fa-times-circle"></i>
                                                <span>Cancel upload</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 d-flex align-items-center">
                                        <div class="fileupload-process w-100">
                                            <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table table-striped files" id="previews">
                                    <div id="template" class="row mt-2">
                                        <div class="col-auto">
                                            <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                                        </div>
                                        <div class="col d-flex align-items-center">
                                            <p class="mb-0">
                                                <span class="lead" data-dz-name></span>
                                                (<span data-dz-size></span>)
                                            </p>
                                            <strong class="error text-danger" data-dz-errormessage></strong>
                                        </div>
                                        <div class="col-4 d-flex align-items-center">
                                            <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                            </div>
                                        </div>
                                        <div class="col-auto d-flex align-items-center">
                                            <div class="btn-group">
                                                <button class="btn btn-primary start">
                                                    <i class="fas fa-upload"></i>
                                                    <span>Start</span>
                                                </button>
                                                <button data-dz-remove class="btn btn-warning cancel">
                                                    <i class="fas fa-times-circle"></i>
                                                    <span>Cancel</span>
                                                </button>
                                                <button data-dz-remove class="btn btn-danger delete">
                                                    <i class="fas fa-trash"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <script>
                        $(function() {
                            // DropzoneJS Demo Code Start
                            Dropzone.autoDiscover = false;

                            // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
                            var previewNode = document.querySelector("#template");
                            previewNode.id = "";
                            var previewTemplate = previewNode.parentNode.innerHTML;
                            previewNode.parentNode.removeChild(previewNode);

                            var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
                                url: "<?= base_url('pengtugas/uploadRevisi') ?>", // Set the url
                                method: "post",
                                paramName: "berkas_revisi",
                                maxFiles: 1,
                                thumbnailWidth: 80,
                                thumbnailHeight: 80,
                                parallelUploads: 20,
                                previewTemplate: previewTemplate,
                                init: function() {
                                    // Set up any event handlers
                                    this.on('queuecomplete', function() {
                                        location.reload();
                                    });
                                    this.on("maxfilesexceeded", function(file) {
                                        Swal.fire(
                                            'Error!',
                                            'File tidak boleh lebih dari 1.',
                                            'error'
                                        )
                                    });
                                },
                                autoQueue: false, // Make sure the files aren't queued until manually added
                                previewsContainer: "#previews", // Define the container to display the previews
                                clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
                            });

                            myDropzone.on("addedfile", function(file) {
                                // Hookup the start button
                                file.previewElement.querySelector(".start").onclick = function() {
                                    myDropzone.enqueueFile(file);
                                };
                            });

                            // Update the total progress bar
                            myDropzone.on("totaluploadprogress", function(progress) {
                                document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
                            });

                            myDropzone.on("sending", function(file, xhr, formData) {
                                // Show the total progress bar when upload starts
                                document.querySelector("#total-progress").style.opacity = "1";
                                // And disable the start button
                                file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
                                var id_pengtugas = "<?= $one_pengtugas['id_pengtugas'] ?>";
                                var id_tugas = $('#id_tugas').val();
                                formData.append('id_tugas', id_tugas);
                                formData.append('id_pengtugas', id_pengtugas);
                            });

                            // Hide the total progress bar when nothing's uploading anymore
                            myDropzone.on("queuecomplete", function(progress) {
                                document.querySelector("#total-progress").style.opacity = "0";
                            });
                            // Setup the buttons for all transfers
                            // The "add files" button doesn't need to be setup because the config
                            // `clickable` has already been specified.
                            document.querySelector("#actions .start").onclick = function() {
                                myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
                            };
                            document.querySelector("#actions .cancel").onclick = function() {
                                myDropzone.removeAllFiles(true);
                            };
                            // DropzoneJS Demo Code End
                        });
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