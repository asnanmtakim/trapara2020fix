<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Data Koreksi Trapara</h1>
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
                        <h3 class="card-title">Edit Data Koreksi Trapara</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open_multipart('koreksi/edit', array('role' => "form", 'id' => "myForm")); ?>
                    <input type="hidden" name="id" id="id" value="<?= $one_koreksi->id_koreksi ?>">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="pemateri">Pengkoreksi 1</label>
                            <div class="input-group">
                                <select class="form-control select2bs4" name="pemateri" id="pemateri">
                                    <option value="" disabled selected>--Pilih Pengkoreksi Tugas--</option>
                                    <?php
                                    foreach ($pemateri as $pmt) {
                                    ?>
                                        <option value='<?= $pmt->id_pemateri ?>' <?php if (set_select("pemateri", "$pmt->id_pemateri")) {
                                                                                        print set_select("pemateri", "$pmt->id_pemateri");
                                                                                    } else {
                                                                                        if ($pmt->id_pemateri == $one_koreksi->id_pemateri) {
                                                                                            print 'selected';
                                                                                        }
                                                                                    }; ?>><?= $pmt->nama_user ?> (<?= $pmt->no_hp_pemateri ?>)</option>
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
                            <label for="pemateri2">Pengkoreksi 2</label>
                            <div class="input-group">
                                <select class="form-control select2bs4" name="pemateri2" id="pemateri2">
                                    <option value="" disabled selected>--Pilih Pengkoreksi Tugas--</option>
                                    <?php
                                    foreach ($pemateri as $pmt) {
                                    ?>
                                        <option value='<?= $pmt->id_pemateri ?>' <?php if (set_select("pemateri2", "$pmt->id_pemateri")) {
                                                                                        print set_select("pemateri2", "$pmt->id_pemateri");
                                                                                    } else {
                                                                                        if ($pmt->id_pemateri == $one_koreksi->id_pemateri2) {
                                                                                            print 'selected';
                                                                                        }
                                                                                    }; ?>><?= $pmt->nama_user ?> (<?= $pmt->no_hp_pemateri ?>)</option>
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
                                        <option value='<?= $kls->id_kelas ?>' <?php if (set_select("kelas", "$kls->id_kelas")) {
                                                                                    print set_select("kelas", "$kls->id_kelas");
                                                                                } else {
                                                                                    if ($kls->id_kelas == $one_koreksi->id_kelas) {
                                                                                        print 'selected';
                                                                                    }
                                                                                }; ?>><?= $kls->nama_kelas ?></option>
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
                            <label for="judul">Judul Tugas</label>
                            <div class="input-group">
                                <select class="form-control select2bs4" name="judul" id="judul">
                                    <option value="" disabled selected>--Pilih Tugas TRAPARA--</option>
                                    <?php
                                    foreach ($tugas as $mtr) {
                                    ?>
                                        <option value='<?= $mtr['id_tugas'] ?>' <?php if (set_select("tugas", '' . $mtr['id_tugas'] . '')) {
                                                                                    print set_select("tugas", '' . $mtr['id_tugas'] . '');
                                                                                } else {
                                                                                    if ($mtr['id_tugas'] == $one_koreksi->id_tugas) {
                                                                                        print 'selected';
                                                                                    }
                                                                                }; ?>><?= $mtr['judul_tugas'] ?></option>
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
                        <button type="submit" name="submit" class="btn btn-primary">Ubah</button>
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
    bsCustomFileInput.init();
</script>