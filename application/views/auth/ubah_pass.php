<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/dist/img/psm.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/toastr/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?php echo base_url() ?>" class="h1"><b>TRAPARA</b> 2020</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Ubah password untuk <?= $this->session->userdata('reset_email') ?></p>
                <p class="login-box-msg">Silahkan input password baru anda!</p>
                <form action="<?= base_url() ?>auth/change_pass" method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <?= form_error('password1', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Ulangi Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <?= form_error('password2', '<p style="color: red; font-size:12px">*', '</p>'); ?>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Ubah password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url() ?>assets/plugins/toastr/toastr.min.js"></script>
    <?php if ($this->session->flashdata('message_error')) { ?>
        <script>
            $(document).ready(function() {
                toastr.error("<?= $this->session->flashdata('message_error'); ?>")
            });
        </script>
    <?php } ?>
    <?php if ($this->session->flashdata('message_success')) { ?>
        <script>
            $(document).ready(function() {
                toastr.success("<?= $this->session->flashdata('message_success'); ?>")
            });
        </script>
    <?php } ?>
</body>

</html>