<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Data Jadwal Trapara</h1>
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
                        <h3 class="card-title">Daftar Jadwal TRAPARA 2020</h3>
                        <div class="float-right">
                            <?php
                            $role = $this->session->userdata('role');
                            if ($role == 0 || $role == 1) {
                                echo anchor('jadwal/post', '<i class="fas fa-plus-circle"></i> Tambah Jadwal', array('title' => 'Tambah jadwal', 'class' => 'btn btn-sm btn-success'));
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
                                        <th>Materi</th>
                                        <th>Tanggal Pelaksanaan</th>
                                        <th>Pemateri</th>
                                        <th>Kelas</th>
                                        <th>File Materi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($jadwal)) {
                                        $no = 0;
                                        foreach ($jadwal as $jdl) {
                                            $tgl_pecah = explode("-", $jdl['materi']->tgl_materi);
                                            $tgl = strtotime($tgl_pecah[0]);
                                            $today = time();
                                            $diff = round(($tgl - $today) / (60 * 60 * 24));
                                            $kurang = '';
                                            if ($diff == 0) {
                                                $kurang = 'Hari ini';
                                            } else if ($diff >= 0) {
                                                $kurang = "$diff Hari lagi";
                                            }
                                            $jam_pecah = explode(" ", $jdl['materi']->tgl_materi);
                                            $jam = $jam_pecah[3] . ' - ' . $jam_pecah[8];
                                    ?>
                                            <tr>
                                                <td><?= ++$no; ?></td>
                                                <td><?= $jdl['materi']->judul_materi ?></td>
                                                <td><?= $tgl_pecah[0] ?> - <?= $jam_pecah[8] ?> <span class="badge badge-info"><?php $kurang != '' ? print $kurang : '' ?></span></td>
                                                <td>
                                                    <ul>
                                                        <li><?= $jdl['pemateri']->nama_user ?></li>
                                                        <?php
                                                        if (isset($jdl['pemateri2'])) {
                                                        ?>
                                                            <li><?= $jdl['pemateri2']->nama_user ?></li>
                                                        <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </td>
                                                <td><?= $jdl['kelas']->nama_kelas ?></td>
                                                <td>
                                                    <ul>
                                                        <?php
                                                        foreach ($jdl['berkas_materi'] as $berkas) {
                                                        ?>
                                                            <li>
                                                                <a href="<?= base_url() ?>assets/uploads/materi/<?= $berkas['id_materi'] ?>/<?= $berkas['berkas_materi'] ?>" target="_blank"><?= $berkas['berkas_materi'] ?></a>
                                                            </li>
                                                        <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo anchor(site_url('jadwal/detail/' . $jdl['id_jadwal']), '<i class="fas fa-eye"></i>', array('title' => 'Detail', 'class' => 'btn btn-primary'));
                                                    echo '&nbsp';
                                                    if ($role == 0 || $role == 1) {
                                                        echo anchor(site_url('jadwal/edit/' . $jdl['id_jadwal']), '<i class="fas fa-edit"></i>', array('title' => 'Edit', 'class' => 'btn btn-sm btn-warning'));
                                                        echo '&nbsp';
                                                    ?>
                                                        <a href="javascript:hapus(<?= $jdl['id_jadwal'] ?>)" title="Hapus" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
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
                    location.href = "jadwal/hapus/" + id;
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