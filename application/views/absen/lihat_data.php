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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Absen TRAPARA 2020</h3>
                        <div class="float-right">
                            <?php
                            echo anchor('absen/post', '<i class="fas fa-plus-circle"></i> Tambah Absen', array('title' => 'Tambah Absen', 'class' => 'btn btn-sm btn-success'));
                            ?>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Absen</th>
                                        <th>Tgl Absensi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($absen)) {
                                        $no = 0;
                                        foreach ($absen as $abs) { ?>
                                            <tr>
                                                <td><?= ++$no; ?></td>
                                                <td><?= $abs->judul_absen ?></td>
                                                <td><?= $abs->tgl_absen ?></td>
                                                <td>
                                                    <?php
                                                    echo anchor(site_url('absen/edit/' . $abs->id_absen), '<i class="fas fa-edit"></i>', array('title' => 'Edit', 'class' => 'btn btn-sm btn-warning'));
                                                    echo '&nbsp';
                                                    ?>
                                                    <a href="javascript:hapus(<?= $abs->id_absen ?>)" title="Hapus" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
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
                    location.href = "absen/hapus/" + id;
                });
            }
        });
    }
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["copy", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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