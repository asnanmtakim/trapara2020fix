<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h1>Data Tugas</h1>
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
                        <h3 class="card-title">Daftar Tugas TRAPARA 2020</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Tugas</th>
                                        <th>Deskripsi Tugas</th>
                                        <th>Batas Pengumpulan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($tugas)) {
                                        $no = 0;
                                        foreach ($tugas as $tgs) {
                                            if ($tgs['status_pengtugas'] == 0) {
                                                $datalabel = [
                                                    'class' => 'badge-danger',
                                                    'value' => 'Belum mengumpulkan'
                                                ];
                                            } else if ($tgs['status_pengtugas'] == 1) {
                                                $datalabel = [
                                                    'class' => 'badge-warning',
                                                    'value' => 'Belum dinilai'
                                                ];
                                            } else if ($tgs['status_pengtugas'] == 2) {
                                                $datalabel = [
                                                    'class' => 'badge-success',
                                                    'value' => 'Sudah dinilai'
                                                ];
                                            }
                                    ?>
                                            <tr>
                                                <td><?= ++$no; ?></td>
                                                <td><?= $tgs['judul_tugas'] ?></td>
                                                <td><?= $tgs['deskripsi_tugas'] ?></td>
                                                <td><?= $tgs['batas_tgl'] ?></td>
                                                <td><span class="badge <?= $datalabel['class'] ?>"><?= $datalabel['value'] ?></span></td>
                                                <td>
                                                    <?php
                                                    if ($tgs['status_pengtugas'] == 0) {
                                                        echo anchor(site_url('pengtugas/kumpul/' . $tgs['id_tugas']), '<i class="fas fa-upload"></i>', array('title' => 'Kumpulkan', 'class' => 'btn btn-primary'));
                                                    } else {
                                                        echo anchor(site_url('pengtugas/kumpul/' . $tgs['id_tugas']), '<i class="fas fa-eye"></i>', array('title' => 'Lihat', 'class' => 'btn btn-primary'));
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