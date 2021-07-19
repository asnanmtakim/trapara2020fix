<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Data Kelas</h1>
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
                        <h3 class="card-title">Edit Data Kelas Trapara</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open_multipart('kelas/edit', array('role' => "form", 'id' => "myForm")); ?>
                    <input type="hidden" name="id" value="<?= $one_kelas->id_kelas ?>">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama Kelas</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Kelas Trapara" value="<?php set_value('nama') ? print set_value('nama') : print $one_kelas->nama_kelas; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                </div>
                            </div>
                            <?= form_error('nama', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="link">Link Kelas</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="link" id="link" placeholder="Link Kelas" value="<?php set_value('link') ? print set_value('link') : print $one_kelas->link_kelas; ?>">
                                <div class=" input-group-append">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                            </div>
                            <?= form_error('link', '<p style="color: red; font-size:12px">*', '</p>'); ?>
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