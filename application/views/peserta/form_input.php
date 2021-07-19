<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Data Peserta</h1>
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
                        <h3 class="card-title">Input Data Peserta</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open_multipart('peserta/post', array('role' => "form", 'id' => "myForm")); ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nim">NIM Peserta</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nim" id="nim" placeholder="NIM Peserta TRAPARA" value="<?= set_value('nim'); ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                            </div>
                            <?= form_error('nim', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Peserta</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Peserta TRAPARA" value="<?= set_value('nama'); ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                </div>
                            </div>
                            <?= form_error('nama', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Peserta</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email Peserta" value="<?= set_value('email'); ?>">
                                <div class=" input-group-append">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                            </div>
                            <?= form_error('email', '<p style="color: red; font-size:12px">*', '</p>'); ?>
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
                            <label for="suara">Suara</label>
                            <div class="input-group">
                                <select class="form-control select2bs4" name="suara" id="suara">
                                    <option value="" disabled selected>--Pilih Suara Peserta--</option>
                                    <option value="Sopran" <?= set_select("suara", "Sopran"); ?>>Sopran</option>
                                    <option value="Alto" <?= set_select("suara", "Alto"); ?>>Alto</option>
                                    <option value="Tenor" <?= set_select("suara", "Tenor"); ?>>Tenor</option>
                                    <option value="Bass" <?= set_select("suara", "Bass"); ?>>Bass</option>
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-voicemail"></i></span>
                                </div>
                            </div>
                            <?= form_error('suara', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto Peserta</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="foto" id="foto">
                                    <label class="custom-file-label" for="foto">Pilih foto</label>
                                </div>
                            </div>
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
        })
    });
    bsCustomFileInput.init();
</script>