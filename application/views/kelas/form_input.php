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
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Input Data Kelas Trapara</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open_multipart('kelas/post', array('role' => "form", 'id' => "myForm")); ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama Kelas</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Kelas" value="<?= set_value('nama'); ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-school"></i></span>
                                </div>
                            </div>
                            <?= form_error('nama', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="link">Link Kelas</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="link" id="link" placeholder="Link Kelas" value="<?= set_value('link'); ?>">
                                <div class=" input-group-append">
                                    <span class="input-group-text"><i class="fas fa-link"></i></span>
                                </div>
                            </div>
                            <?= form_error('link', '<p style="color: red; font-size:12px">*', '</p>'); ?>
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