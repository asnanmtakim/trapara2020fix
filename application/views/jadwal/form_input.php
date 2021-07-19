<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Data Jadwal Trapara</h1>
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
                        <h3 class="card-title">Input Data Jadwal Trapara</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open_multipart('jadwal/post', array('role' => "form", 'id' => "myForm")); ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="pemateri">Pemateri 1</label>
                            <div class="input-group">
                                <select class="form-control select2bs4" name="pemateri" id="pemateri">
                                    <option value="" disabled selected>--Pilih Pemateri 1 TRAPARA--</option>
                                    <?php
                                    foreach ($pemateri as $pmt) {
                                    ?>
                                        <option value="<?= $pmt->id_pemateri ?>" <?= set_select("pemateri", "$pmt->id_pemateri"); ?>><?= $pmt->nama_user ?> (<?= $pmt->no_hp_pemateri ?>)</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                </div>
                            </div>
                            <?= form_error('pemateri', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="pemateri2">Pemateri 2</label>
                            <div class="input-group">
                                <select class="form-control select2bs4" name="pemateri2" id="pemateri2">
                                    <option value="" disabled selected>--Pilih Pemateri 2 TRAPARA--</option>
                                    <?php
                                    foreach ($pemateri as $pmt) {
                                    ?>
                                        <option value="<?= $pmt->id_pemateri ?>" <?= set_select("pemateri2", "$pmt->id_pemateri"); ?>><?= $pmt->nama_user ?> (<?= $pmt->no_hp_pemateri ?>)</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                </div>
                            </div>
                            <?= form_error('pemateri2', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <div class="input-group">
                                <select class="form-control select2bs4" name="kelas" id="kelas">
                                    <option value="" disabled selected>--Pilih Kelas TRAPARA--</option>
                                    <?php
                                    foreach ($kelas as $kls) {
                                    ?>
                                        <option value="<?= $kls->id_kelas ?>" <?= set_select("kelas", "$kls->id_kelas"); ?>> <?= $kls->nama_kelas ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-school"></i></span>
                                </div>
                            </div>
                            <?= form_error('kelas', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul Materi / Topik</label>
                            <div class="input-group">
                                <select class="form-control select2bs4" name="judul" id="judul">
                                    <option value="" disabled selected>--Pilih Materi/Topik TRAPARA--</option>
                                    <?php
                                    foreach ($materi as $mtr) {
                                    ?>
                                        <option value="<?= $mtr['id_materi'] ?>" <?= set_select("judul", '' . $mtr['id_materi'] . ''); ?>><?= $mtr['judul_materi'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                </div>
                            </div>
                            <?= form_error('judul', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.card -->
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
    });
</script>