<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Data Tugas Peserta</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php
                if ($this->session->userdata('role') == 2) {
                ?>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Tugas Peserta Trapara 2020</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pengkoreksi</th>
                                            <th>Kelas</th>
                                            <th>Tugas</th>
                                            <th>Batas Pengumpulan</th>
                                            <th>Jumlah Pengumpulan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($koreksi)) {
                                            $no = 0;
                                            foreach ($koreksi as $krs) {
                                        ?>
                                                <tr>
                                                    <td><?= ++$no; ?></td>
                                                    <td>
                                                        <ul>
                                                            <li><?= $krs['pemateri']->nama_user ?></li>
                                                            <?php
                                                            if (isset($jdl['pemateri2'])) {
                                                            ?>
                                                                <li><?= $jdl['pemateri2']->nama_user ?></li>
                                                            <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </td>
                                                    <td><?= $krs['kelas']->nama_kelas ?></td>
                                                    <td><?= $krs['tugas']->judul_tugas ?></td>
                                                    <td><?= $krs['tugas']->batas_tgl ?></td>
                                                    <td><?= $krs['jum_pengtugas'] ?></td>
                                                    <td>
                                                        <?php
                                                        echo anchor(site_url('koreksi/detail/' . $krs['id_koreksi']), '<i class="fas fa-eye"></i>', array('title' => 'Detail', 'class' => 'btn btn-primary'));
                                                        ?>
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
                <?php
                } else {
                ?>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Koreksi Tugas TRAPARA 2020</h3>
                            <div class="float-right">
                                <?php
                                $role = $this->session->userdata('role');
                                if ($role == 0 || $role == 1) {
                                    echo anchor('koreksi/post', '<i class="fas fa-plus-circle"></i> Tambah Koreksi', array('title' => 'Tambah Koreksi', 'class' => 'btn btn-sm btn-success'));
                                }
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
                                            <th>Pengkoreksi</th>
                                            <th>Kelas</th>
                                            <th>Tugas</th>
                                            <th>Batas Pengumpulan</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($koreksi)) {
                                            $no = 0;
                                            foreach ($koreksi as $krs) {
                                        ?>
                                                <tr>
                                                    <td><?= ++$no; ?></td>
                                                    <td>
                                                        <ul>
                                                            <li><?= $krs['pemateri']->nama_user ?></li>
                                                            <?php
                                                            if (isset($krs['pemateri2'])) {
                                                            ?>
                                                                <li><?= $krs['pemateri2']->nama_user ?></li>
                                                            <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </td>
                                                    <td><?= $krs['kelas']->nama_kelas ?></td>
                                                    <td><?= $krs['tugas']->judul_tugas ?></td>
                                                    <td><?= $krs['tugas']->batas_tgl ?></td>
                                                    <td><?= $krs['total_koreksi'] ?></td>
                                                    <td>
                                                        <?php
                                                        echo anchor(site_url('koreksi/detail/' . $krs['id_koreksi']), '<i class="fas fa-eye"></i>', array('title' => 'Detail', 'class' => 'btn btn-primary'));
                                                        echo '&nbsp';
                                                        if ($role == 0 || $role == 1) {
                                                            echo anchor(site_url('koreksi/edit/' . $krs['id_koreksi']), '<i class="fas fa-edit"></i>', array('title' => 'Edit', 'class' => 'btn btn-sm btn-warning'));
                                                            echo '&nbsp';
                                                        ?>
                                                            <a href="javascript:hapus(<?= $krs['id_koreksi'] ?>)" title="Hapus" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                        <?php
                                                        }
                                                        ?>
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
                <?php
                }
                ?>
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
                    location.href = "koreksi/hapus/" + id;
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