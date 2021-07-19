<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Data Pemateri</h1>
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
                        <h3 class="card-title">Edit Data pemateri Trapara</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open_multipart('pemateri/edit', array('role' => "form", 'id' => "myForm")); ?>
                    <input type="hidden" name="id" value="<?= $one_pemateri->id_pemateri ?>">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama Pemateri</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama pemateri TRAPARA" value="<?php set_value('nama') ? print set_value('nama') : print $one_pemateri->nama_user; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                </div>
                            </div>
                            <?= form_error('nama', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Pemateri</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email pemateri" value="<?php set_value('email') ? print set_value('email') : print $one_pemateri->email_user; ?>">
                                <div class=" input-group-append">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                            </div>
                            <?= form_error('email', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No HP Pemateri</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No HP pemateri" value="<?php set_value('no_hp') ? print set_value('no_hp') : print $one_pemateri->no_hp_pemateri; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                            </div>
                            <?= form_error('no_hp', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto Pemateri</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="foto" id="foto">
                                    <label class="custom-file-label" for="foto"><?= $one_pemateri->foto ?></label>
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