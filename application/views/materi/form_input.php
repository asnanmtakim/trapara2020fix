<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Data Materi</h1>
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
                        <h3 class="card-title">Input Data Materi Trapara</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open_multipart('materi/post', array('role' => "form", 'id' => "myForm")); ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tgl">Tanggal Pelaksanaan</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="tgl" id="tgl" placeholder="Tanggal Pelaksanaan" value="<?= set_value('tgl'); ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                            </div>
                            <?= form_error('tgl', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul Materi</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul materi" value="<?= set_value('judul'); ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                </div>
                            </div>
                            <?= form_error('judul', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi materi</label>
                            <div class="input-group">
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4" placeholder="Deskripsi materi ..."><?= set_value('deskripsi'); ?></textarea>
                            </div>
                            <?= form_error('deskripsi', '<p style="color: red; font-size:12px">*', '</p>'); ?>
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
        //Date range picker with time picker
        $('#tgl').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(1.5, 'hour'),
            locale: {
                format: 'DD MMM YYYY HH:mm'
            }
        })
    });
</script>