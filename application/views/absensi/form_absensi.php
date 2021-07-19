<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Absensi Peserta</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Detail Absensi</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Tanggal Absensi</b>
                                <br>
                                <a><?= $one_absen['tgl_absen'] ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Judul Absensi</b>
                                <br>
                                <a><?= $one_absen['judul_absen'] ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Peserta Masuk</b>
                                <br>
                                <a><?= $one_absen['jum_peserta'] ?></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Peserta</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama Peserta</th>
                                        <th>Kelas</th>
                                        <th>Suara</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    foreach ($absensi as $absi) {
                                        if ($absi->status == 0) {
                                            $label = [
                                                'class' => 'badge-danger',
                                                'value' => 'Tidak Masuk'
                                            ];
                                        } else if ($absi->status == 1) {
                                            $label = [
                                                'class' => 'badge-warning',
                                                'value' => 'Izin'
                                            ];
                                        } else if ($absi->status == 2) {
                                            $label = [
                                                'class' => 'badge-success',
                                                'value' => 'Masuk'
                                            ];
                                        }
                                    ?>
                                        <tr>
                                            <td><?= ++$no; ?></td>
                                            <td><?= $absi->nim ?></td>
                                            <td><?= $absi->nama_user ?></td>
                                            <td><?= $absi->nama_kelas ?></td>
                                            <td><?= $absi->suara ?></td>
                                            <td>
                                                <h5><span class="badge <?= $label['class'] ?>"><?= $label['value'] ?></span></h5>
                                            </td>
                                            <td>
                                                <button name="absensi" class="btn btn-sm btn-warning absensi_peserta" title="Absen Peserta" id="<?= $absi->id_absensi ?>"><i class="fas fa-external-link-alt"></i></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade" id="modal-absensi">
            <div class="modal-dialog">
                <div class="modal-content bg-info">
                    <div class="modal-header">
                        <h4 class="modal-title">Absensi Peserta</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="<?= base_url('absensi/editAbsensi') ?>" method="POST">
                        <div class="modal-body">
                            <input type="hidden" id="id_absensi" name="id_absensi">
                            <input type="hidden" id="id_absen" name="id_absen">
                            <div class="form-group">
                                <label for="nama">Nama Peserta</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nama" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Status Absensi</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="status_0" name="status" value="0">
                                    <label class="form-check-label" for="status_0">Alfa/Tidak masuk</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="status_1" name="status" value="1">
                                    <label class="form-check-label" for="status_1">Izin</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="status_2" name="status" value="2">
                                    <label class="form-check-label" for="status_2">Masuk</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan Absensi</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan absensi">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                            <button type="submit" class="submit btn btn-outline-light">Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<script>
    $(function() {
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false
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

        $(document).on('click', '.absensi_peserta', function() {
            var id_absensi = $(this).attr("id");
            $.ajax({
                url: "<?= base_url('absensi/absensiPeserta') ?>",
                method: "POST",
                data: {
                    id_absensi: id_absensi
                },
                dataType: "json",
                success: function(data) {
                    $('#id_absensi').val(data.id_absensi);
                    $('#id_absen').val(data.id_absen);
                    $('#nama').val(data.nama_user);
                    if (data.status == 0) {
                        $('#status_0').attr('checked', true).change();
                    } else if (data.status == 1) {
                        $('#status_1').attr('checked', true).change();
                    } else {
                        $('#status_2').attr('checked', true).change();
                    }
                    $('#keterangan').val(data.keterangan);
                    $('#modal-absensi').modal('show');
                    console.log(data);
                }
            });
        });
    });
    bsCustomFileInput.init();
</script>