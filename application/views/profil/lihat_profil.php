<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Profil Pengguna</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php
        $role = $this->session->userdata('role');
        if ($role == 4) {
        ?>
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/uploads/foto_user/') . $peserta->foto ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $peserta->nama_user ?></h3>

                            <p class="text-muted text-center">Peserta</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="text-center list-group-item">
                                    <p><?= $peserta->email_user ?></p>
                                </li>
                                <li class="list-group-item">
                                    <b>NIM</b> <a class="float-right"><?= $peserta->nim ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Kelas</b> <a class="float-right"><?= $peserta->nama_kelas ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Suara</b> <a class="float-right"><?= $peserta->suara ?></a>
                                </li>
                            </ul>
                            <a href="<?= base_url() ?>auth/logout" class="btn btn-warning btn-block"><b>Logout</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link" href="#uprofil" data-toggle="tab">Ubah Data Profil</a></li>
                                <li class="nav-item"><a class="nav-link" href="#ufoto" data-toggle="tab">Ubah Foto Pengguna</a></li>
                                <li class="nav-item"><a class="nav-link active" href="#upassword" data-toggle="tab">Ubah Password</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" id="uprofil">
                                    <form class="form-horizontal" id="formUbahProfilAdmin" action="<?= base_url('profil/editProfilPeserta') ?>" method="POST">
                                        <div class="form-group row">
                                            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                                            <div class="col-sm-10 input-group">
                                                <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM Peserta" value="<?= $peserta->nim ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10 input-group">
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pengguna" value="<?= $peserta->nama_user ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="ufoto">
                                    <img src="<?= base_url('assets/uploads/foto_user/') . $peserta->foto ?>" width="30%" class="img-fluid rounded mx-auto d-block mb-3" alt="">
                                    <?= form_open_multipart('profil/editFotoUser', array('role' => "form", 'class' => 'form-horizontal', 'id' => "formUbahFotoUser")); ?>
                                    <div class="form-group row">
                                        <label for="foto" class="col-sm-2 col-form-label">Foto Baru</label>
                                        <div class="col-sm-10 input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="foto" id="foto">
                                                <label class="custom-file-label" for="foto">Upload foto (max 2 MB) ...</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-success">Simpan dan Upload</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="active tab-pane" id="upassword">
                                    <form class="form-horizontal" id="formUbahPassUser" action="<?= base_url('profil/editPasswordUser') ?>" method="POST">
                                        <div class="form-group row">
                                            <label for="password_lm" class="col-sm-3 col-form-label">Password Lama</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="password" class="form-control" id="password_lm" name="password_lm" placeholder="Password lama">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password_br" class="col-sm-3 col-form-label">Password Baru</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="password" class="form-control" id="password_br" name="password_br" placeholder="Password baru">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password_br2" class="col-sm-3 col-form-label">Password Baru (ulangi)</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="password" class="form-control" id="password_br2" name="password_br2" placeholder="Password baru (ulangi)">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-9">
                                                <button type="submit" class="btn btn-success">Ubah Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <script>
                $(function() {
                    $('#formUbahProfilAdmin').validate({
                        rules: {
                            nim: {
                                required: true,
                                minlength: 9,
                            },
                            nama: {
                                required: true,
                                minlength: 3,
                            },
                        },
                        messages: {
                            nim: {
                                required: "NIM tidak boleh kosong!",
                                minlength: "NIM minimal berisi 9 karakter!"
                            },
                            nama: {
                                required: "Nama pengguna tidak boleh kosong!",
                                minlength: "Nama pengguna minimal berisi 3 karakter!"
                            },
                        },
                        errorElement: 'span',
                        errorPlacement: function(error, element) {
                            error.addClass('invalid-feedback');
                            element.closest('.input-group').append(error);
                        },
                        highlight: function(element, errorClass, validClass) {
                            $(element).addClass('is-invalid');
                        },
                        unhighlight: function(element, errorClass, validClass) {
                            $(element).removeClass('is-invalid');
                        },
                        submitHandler: function(form) {
                            form.submit();
                        }
                    });
                });
            </script>
        <?php
        } else if ($role == 3) {
        ?>
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/uploads/foto_user/') . $pemateri->foto ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $pemateri->nama_user ?></h3>

                            <p class="text-muted text-center">Pemateri</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="text-center list-group-item">
                                    <p><?= $pemateri->email_user ?></p>
                                </li>
                                <li class="list-group-item">
                                    <b>No HP</b> <a class="float-right"><?= $pemateri->no_hp_pemateri ?></a>
                                </li>
                            </ul>
                            <a href="<?= base_url() ?>auth/logout" class="btn btn-warning btn-block"><b>Logout</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link" href="#uprofil" data-toggle="tab">Ubah Data Profil</a></li>
                                <li class="nav-item"><a class="nav-link" href="#ufoto" data-toggle="tab">Ubah Foto Pengguna</a></li>
                                <li class="nav-item"><a class="nav-link active" href="#upassword" data-toggle="tab">Ubah Password</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" id="uprofil">
                                    <form class="form-horizontal" id="formUbahProfilUser" action="<?= base_url('profil/editProfilPemateri') ?>" method="POST">
                                        <div class="form-group row">
                                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10 input-group">
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pengguna" value="<?= $pemateri->nama_user ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                                            <div class="col-sm-10 input-group">
                                                <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="No HP" value="<?= $pemateri->no_hp_pemateri ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="ufoto">
                                    <img src="<?= base_url('assets/uploads/foto_user/') . $pemateri->foto ?>" width="30%" class="img-fluid rounded mx-auto d-block mb-3" alt="">
                                    <?= form_open_multipart('profil/editFotoUser', array('role' => "form", 'class' => 'form-horizontal', 'id' => "formUbahFotoUser")); ?>
                                    <div class="form-group row">
                                        <label for="foto" class="col-sm-2 col-form-label">Foto Baru</label>
                                        <div class="col-sm-10 input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="foto" id="foto">
                                                <label class="custom-file-label" for="foto">Upload foto (max 2 MB) ...</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-success">Simpan dan Upload</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="active tab-pane" id="upassword">
                                    <form class="form-horizontal" id="formUbahPassUser" action="<?= base_url('profil/editPasswordUser') ?>" method="POST">
                                        <div class="form-group row">
                                            <label for="password_lm" class="col-sm-3 col-form-label">Password Lama</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="password" class="form-control" id="password_lm" name="password_lm" placeholder="Password lama">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password_br" class="col-sm-3 col-form-label">Password Baru</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="password" class="form-control" id="password_br" name="password_br" placeholder="Password baru">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password_br2" class="col-sm-3 col-form-label">Password Baru (ulangi)</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="password" class="form-control" id="password_br2" name="password_br2" placeholder="Password baru (ulangi)">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-9">
                                                <button type="submit" class="btn btn-success">Ubah Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <script>
                $(function() {
                    $('#formUbahProfilUser').validate({
                        rules: {
                            no_hp: {
                                required: true,
                                minlength: 10,
                            },
                            nama: {
                                required: true,
                                minlength: 3,
                            },
                        },
                        messages: {
                            no_hp: {
                                required: "No HP tidak boleh kosong!",
                                minlength: "No HP minimal berisi 10 karakter!"
                            },
                            nama: {
                                required: "Nama pengguna tidak boleh kosong!",
                                minlength: "Nama pengguna minimal berisi 3 karakter!"
                            },
                        },
                        errorElement: 'span',
                        errorPlacement: function(error, element) {
                            error.addClass('invalid-feedback');
                            element.closest('.input-group').append(error);
                        },
                        highlight: function(element, errorClass, validClass) {
                            $(element).addClass('is-invalid');
                        },
                        unhighlight: function(element, errorClass, validClass) {
                            $(element).removeClass('is-invalid');
                        },
                        submitHandler: function(form) {
                            form.submit();
                        }
                    });
                });
            </script>
        <?php
        } else if ($role == 2) {
        ?>
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/uploads/foto_user/') . $penjab->foto ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $penjab->nama_user ?></h3>

                            <p class="text-muted text-center">PJ Kelas</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="text-center list-group-item">
                                    <p><?= $penjab->email_user ?></p>
                                </li>
                                <li class="list-group-item">
                                    <b>Kelas</b> <a class="float-right"><?= $penjab->nama_kelas ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>No HP</b> <a class="float-right"><?= $penjab->no_hp_pj ?></a>
                                </li>
                            </ul>
                            <a href="<?= base_url() ?>auth/logout" class="btn btn-warning btn-block"><b>Logout</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link" href="#uprofil" data-toggle="tab">Ubah Data Profil</a></li>
                                <li class="nav-item"><a class="nav-link" href="#ufoto" data-toggle="tab">Ubah Foto Pengguna</a></li>
                                <li class="nav-item"><a class="nav-link active" href="#upassword" data-toggle="tab">Ubah Password</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" id="uprofil">
                                    <form class="form-horizontal" id="formUbahProfilUser" action="<?= base_url('profil/editProfilPenjab') ?>" method="POST">
                                        <div class="form-group row">
                                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10 input-group">
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pengguna" value="<?= $penjab->nama_user ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                                            <div class="col-sm-10 input-group">
                                                <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="No HP" value="<?= $penjab->no_hp_pj ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="ufoto">
                                    <img src="<?= base_url('assets/uploads/foto_user/') . $penjab->foto ?>" width="30%" class="img-fluid rounded mx-auto d-block mb-3" alt="">
                                    <?= form_open_multipart('profil/editFotoUser', array('role' => "form", 'class' => 'form-horizontal', 'id' => "formUbahFotoUser")); ?>
                                    <div class="form-group row">
                                        <label for="foto" class="col-sm-2 col-form-label">Foto Baru</label>
                                        <div class="col-sm-10 input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="foto" id="foto">
                                                <label class="custom-file-label" for="foto">Upload foto (max 2 MB) ...</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-success">Simpan dan Upload</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="active tab-pane" id="upassword">
                                    <form class="form-horizontal" id="formUbahPassUser" action="<?= base_url('profil/editPasswordUser') ?>" method="POST">
                                        <div class="form-group row">
                                            <label for="password_lm" class="col-sm-3 col-form-label">Password Lama</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="password" class="form-control" id="password_lm" name="password_lm" placeholder="Password lama">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password_br" class="col-sm-3 col-form-label">Password Baru</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="password" class="form-control" id="password_br" name="password_br" placeholder="Password baru">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password_br2" class="col-sm-3 col-form-label">Password Baru (ulangi)</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="password" class="form-control" id="password_br2" name="password_br2" placeholder="Password baru (ulangi)">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-9">
                                                <button type="submit" class="btn btn-success">Ubah Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <script>
                $(function() {
                    $('#formUbahProfilUser').validate({
                        rules: {
                            no_hp: {
                                required: true,
                                minlength: 10,
                            },
                            nama: {
                                required: true,
                                minlength: 3,
                            },
                        },
                        messages: {
                            no_hp: {
                                required: "No HP tidak boleh kosong!",
                                minlength: "No HP minimal berisi 10 karakter!"
                            },
                            nama: {
                                required: "Nama pengguna tidak boleh kosong!",
                                minlength: "Nama pengguna minimal berisi 3 karakter!"
                            },
                        },
                        errorElement: 'span',
                        errorPlacement: function(error, element) {
                            error.addClass('invalid-feedback');
                            element.closest('.input-group').append(error);
                        },
                        highlight: function(element, errorClass, validClass) {
                            $(element).addClass('is-invalid');
                        },
                        unhighlight: function(element, errorClass, validClass) {
                            $(element).removeClass('is-invalid');
                        },
                        submitHandler: function(form) {
                            form.submit();
                        }
                    });
                });
            </script>
        <?php
        } else {
        ?>
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/uploads/foto_user/') . $admin->foto ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $admin->nama_user ?></h3>

                            <p class="text-muted text-center">Administrator</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <p><?= $admin->email_user ?></p>
                                </li>
                            </ul>
                            <a href="<?= base_url() ?>auth/logout" class="btn btn-warning btn-block"><b>Logout</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link" href="#uprofil" data-toggle="tab">Ubah Data Profil</a></li>
                                <li class="nav-item"><a class="nav-link" href="#ufoto" data-toggle="tab">Ubah Foto Pengguna</a></li>
                                <li class="nav-item"><a class="nav-link active" href="#upassword" data-toggle="tab">Ubah Password</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" id="uprofil">
                                    <form class="form-horizontal" id="formUbahProfilAdmin" action="<?= base_url('profil/editProfilUser') ?>" method="POST">
                                        <div class="form-group row">
                                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10 input-group">
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pengguna" value="<?= $admin->nama_user ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="ufoto">
                                    <img src="<?= base_url('assets/uploads/foto_user/') . $admin->foto ?>" width="30%" class="img-fluid rounded mx-auto d-block mb-3" alt="">
                                    <?= form_open_multipart('profil/editFotoUser', array('role' => "form", 'class' => 'form-horizontal', 'id' => "formUbahFotoUser")); ?>
                                    <div class="form-group row">
                                        <label for="foto" class="col-sm-2 col-form-label">Foto Baru</label>
                                        <div class="col-sm-10 input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="foto" id="foto">
                                                <label class="custom-file-label" for="foto">Upload foto (max 2 MB) ...</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-success">Simpan dan Upload</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="active tab-pane" id="upassword">
                                    <form class="form-horizontal" id="formUbahPassUser" action="<?= base_url('profil/editPasswordUser') ?>" method="POST">
                                        <div class="form-group row">
                                            <label for="password_lm" class="col-sm-3 col-form-label">Password Lama</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="password" class="form-control" id="password_lm" name="password_lm" placeholder="Password lama">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password_br" class="col-sm-3 col-form-label">Password Baru</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="password" class="form-control" id="password_br" name="password_br" placeholder="Password baru">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password_br2" class="col-sm-3 col-form-label">Password Baru (ulangi)</label>
                                            <div class="col-sm-9 input-group">
                                                <input type="password" class="form-control" id="password_br2" name="password_br2" placeholder="Password baru (ulangi)">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-9">
                                                <button type="submit" class="btn btn-success">Ubah Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <script>
                $(function() {
                    $('#formUbahProfilAdmin').validate({
                        rules: {
                            nama: {
                                required: true,
                                minlength: 3,
                            },
                        },
                        messages: {
                            nama: {
                                required: "Nama pengguna tidak boleh kosong!",
                                minlength: "Nama pengguna minimal berisi 3 karakter!"
                            },
                        },
                        errorElement: 'span',
                        errorPlacement: function(error, element) {
                            error.addClass('invalid-feedback');
                            element.closest('.input-group').append(error);
                        },
                        highlight: function(element, errorClass, validClass) {
                            $(element).addClass('is-invalid');
                        },
                        unhighlight: function(element, errorClass, validClass) {
                            $(element).removeClass('is-invalid');
                        },
                        submitHandler: function(form) {
                            form.submit();
                        }
                    });
                });
            </script>
        <?php
        }
        ?>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<script>
    $(function() {
        $('#formUbahFotoUser').validate({
            rules: {
                foto: {
                    required: true,
                },
            },
            messages: {
                foto: {
                    required: "Foto pengguna tidak boleh kosong!",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.input-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
        $('#formUbahPassUser').validate({
            rules: {
                password_lm: {
                    required: true,
                },
                password_br: {
                    required: true,
                    minlength: 6
                },
                password_br2: {
                    minlength: 6,
                    equalTo: "#password_br"
                },
            },
            messages: {
                password_lm: {
                    required: "Password lama harus diisi!",
                },
                password_br: {
                    required: "Password baru harus diisi!",
                    minlength: "Password baru harus berisi minimal 6 karakter!"
                },
                password_br2: {
                    minlength: "Password baru harus berisi minimal 6 karakter!",
                    equalTo: "Password confirm tidak cocok!"
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.input-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
    bsCustomFileInput.init();
</script>