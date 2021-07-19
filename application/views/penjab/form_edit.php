<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Data Penanggung Jawab</h1>
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
                        <h3 class="card-title">Edit Data PJ Trapara</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open_multipart('penjab/edit', array('role' => "form", 'id' => "myForm")); ?>
                    <input type="hidden" name="id" value="<?= $one_pj->id_pj ?>">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama PJ</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama pj TRAPARA" value="<?php set_value('nama') ? print set_value('nama') : print $one_pj->nama_user; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                </div>
                            </div>
                            <?= form_error('nama', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Email PJ</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email pj" value="<?php set_value('email') ? print set_value('email') : print $one_pj->email_user; ?>">
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
                                                                                    if ($kls->id_kelas == $one_pj->id_kelas) {
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
                            <label for="foto">Foto PJ</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="foto" id="foto">
                                    <label class="custom-file-label" for="foto"><?= $one_pj->foto ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No HP PJ</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No HP PJ" value="<?php set_value('no_hp') ? print set_value('no_hp') : print $one_pj->no_hp_pj; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                            </div>
                            <?= form_error('no_hp', '<p style="color: red; font-size:12px">*', '</p>'); ?>
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