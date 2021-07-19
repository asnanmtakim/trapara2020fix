<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Koreksi Tugas Peserta</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Penilaian Tugas Peserta</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Detail Tugas</th>
                                    <td>
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
                                <tr>
                                    <th>Peserta</th>
                                    <td>: <?= $peserta->nama_user ?> (<?= $peserta->suara ?>)</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pengumpulan</th>

                                    <td>: <?= date("d M Y H:i", $pengtugas['tgl_peng']) ?>
                                        <?php
                                        if ($pengtugas['tgl_peng'] > strtotime($tugas->batas_tgl)) {
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
                                                    <td><?= $pengtugas['berkas_peng']['name'] ?></td>
                                                    <td><?= round((intval($pengtugas['berkas_peng']['size']) / 1024), 2) ?> kB</td>
                                                    <td class="text-left py-0 align-middle">
                                                        <a href="<?= site_url($pengtugas['berkas_peng']['server_path']) ?>" target="_blank" class="btn btn-sm btn-info" title="Lihat"><i class="fas fa-eye"> Lihat</i></a>
                                                        <?php
                                                        if (time() < strtotime($tugas->batas_tgl)) {
                                                        ?>
                                                            <a href="javascript:hapus(<?= $pengtugas['id_pengtugas'] ?>)" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></a>
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
                                    <th>Penilaian</th>
                                    <td>
                                        <div class="alert alert-info alert-dismissible">
                                            <h5><i class="icon fas fa-star"></i> Nilai tugas!</h5>
                                            Silahkan input nilai dan catatan tugas peserta dibawah.
                                        </div>
                                        <?= form_open_multipart('koreksi/input_nilai', array('role' => "form", 'id' => "myForm")); ?>
                                        <input type="hidden" name="id_pengtugas" value="<?= $pengtugas['id_pengtugas'] ?>">
                                        <input type="hidden" name="id_koreksi" value="<?= $id_koreksi ?>">
                                        <div class="form-group">
                                            <label for="nilai">Nilai Tugas</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="nilai" id="nilai" placeholder="Nilai Tugas (1-100)" value="<?= $pengtugas['nilai']; ?>" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-star"></i></span>
                                                </div>
                                            </div>
                                            <?= form_error('nilai', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="komentar">Komentar/catatan</label>
                                            <div class="input-group">
                                                <textarea class="form-control" name="komentar" id="komentar" rows="3" placeholder="Komentar / catatan ..." required><?= $pengtugas['komentar']; ?></textarea>
                                            </div>
                                            <?= form_error('komentar', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="submit" class="btn btn-success">Nilai dan Simpan</button>
                                        </div>
                                        </form>
                                    </td>
                                </tr>
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
    $(function() {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    });
    bsCustomFileInput.init();
</script>