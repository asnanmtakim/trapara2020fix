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
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data Peserta</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open_multipart('peserta/edit', array('role' => "form", 'id' => "myForm")); ?>
                    <input type="hidden" name="id" value="<?= $one_peserta->id_peserta ?>">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nim">NIM Peserta</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nim" id="nim" placeholder="NIM Peserta TRAPARA" value="<?php set_value('nim') ? print set_value('nim') : print $one_peserta->nim; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                            </div>
                            <?= form_error('nim', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Peserta</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Peserta TRAPARA" value="<?php set_value('nama') ? print set_value('nama') : print $one_peserta->nama_user; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                </div>
                            </div>
                            <?= form_error('nama', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Peserta</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email Peserta" value="<?php set_value('email') ? print set_value('email') : print $one_peserta->email_user; ?>">
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
                                        <option value='<?= $kls->id_kelas ?>' <?php if (set_select("kelas", "$kls->id_kelas")) {
                                                                                    print set_select("kelas", "$kls->id_kelas");
                                                                                } else {
                                                                                    if ($kls->id_kelas == $one_peserta->id_kelas) {
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
                            <label for="suara">Suara</label>
                            <div class="input-group">
                                <select class="form-control select2bs4" name="suara" id="suara">
                                    <option value="" disabled selected>--Pilih Suara Peserta--</option>
                                    <option value='Sopran' <?php if (set_select("suara", "Sopran")) {
                                                                print set_select("suara", "Sopran");
                                                            } else {
                                                                if ($one_peserta->suara == 'Sopran') {
                                                                    print 'selected';
                                                                }
                                                            }; ?>>Sopran</option>
                                    <option value='Alto' <?php if (set_select("suara", "Alto")) {
                                                                print set_select("suara", "Alto");
                                                            } else {
                                                                if ($one_peserta->suara == 'Alto') {
                                                                    print 'selected';
                                                                }
                                                            }; ?>>Alto</option>
                                    <option value='Tenor' <?php if (set_select("suara", "Tenor")) {
                                                                print set_select("suara", "Tenor");
                                                            } else {
                                                                if ($one_peserta->suara == 'Tenor') {
                                                                    print 'selected';
                                                                }
                                                            }; ?>>Tenor</option>
                                    <option value='Bass' <?php if (set_select("suara", "Bass")) {
                                                                print set_select("suara", "Bass");
                                                            } else {
                                                                if ($one_peserta->suara == 'Bass') {
                                                                    print 'selected';
                                                                }
                                                            }; ?>>Bass</option>
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
                                    <label class="custom-file-label" for="foto"><?= $one_peserta->foto ?></label>
                                </div>
                            </div>
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
        })
    });
    bsCustomFileInput.init();
</script>