<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Data Sebaran Kelas</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        <div class="row">
            <?php
            foreach ($sebaran as $sb) {
            ?>
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Peserta Kelas <?= $sb['nama_kelas'] ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table">
                                <?php
                                $no = 0;
                                foreach ($sb['pj'] as $pj) {
                                ?>
                                    <tr>
                                        <td>Penanggung Jawab <?= ++$no; ?></td>
                                        <td>: <?= $pj['nama_user'] ?> (<?= $pj['no_hp_pj'] ?>)</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama Peserta</th>
                                            <th>Email</th>
                                            <th>Suara</th>
                                            <th>Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        foreach ($sb['peserta'] as $pst) { ?>
                                            <tr>
                                                <td><?= ++$no; ?></td>
                                                <td><?= $pst['nim'] ?></td>
                                                <td><?= $pst['nama_user'] ?></td>
                                                <td><?= $pst['email_user'] ?></td>
                                                <td><?= $pst['suara'] ?></td>
                                                <td>
                                                    <a href="<?= (site_url('assets/uploads/foto_user/' . $pst['foto'])); ?>" class="image-link">
                                                        <img src="<?= (site_url('assets/uploads/foto_user/' . $pst['foto'])); ?>" alt="" style="width:30px;height:30px">
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<!-- /.content -->
<script>
    function hapus(id) {
        Swal.fire({
            title: 'Yakin hapus data?',
            text: "Data yang sudah dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Terhapus!',
                    'Data berhasil dihapus.',
                    'success'
                ).then((result) => {
                    location.href = "kelas/hapus/" + id;
                });
            }
        });
    }
    $(function() {
        $('.image-link').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            fixedContentPos: true,
            image: {
                verticalFit: true
            },
            zoom: {
                enabled: true,
                duration: 300 // don't foget to change the duration also in CSS
            },
        });
    });
</script>