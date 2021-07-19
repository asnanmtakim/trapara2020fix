<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Data Absen</h1>
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
                        <h3 class="card-title">Edit Data Absen Trapara</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open_multipart('absen/edit', array('role' => "form", 'id' => "myForm")); ?>
                    <input type="hidden" name="id" id="id_absen" value="<?= $one_absen->id_absen ?>">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tgl">Batas Pengumpulan</label>
                            <div class="input-group">
                                <input type="text" class="form-control datetimepicker-input" id="tgl" name="tgl" data-toggle="datetimepicker" data-target="#tgl" value="<?php set_value('tgl') ? print set_value('tgl') : print $one_absen->tgl_absen;; ?>" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                            </div>
                            <?= form_error('tgl', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul absen</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul absen" value="<?php set_value('judul') ? print set_value('judul') : print $one_absen->judul_absen; ?>">
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
        //Date range picker with time picker
        $('#tgl').datetimepicker({
            format: 'DD MMM YYYY',
            icons: {
                time: "fas fa-clock",
            }
        });
    });
    bsCustomFileInput.init();
</script>