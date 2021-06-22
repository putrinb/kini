<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
    <div class="wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container">
                <?php if ($this->session->flashdata('flash')) : ?>
                    <div class="div row mt-3">
                        <div class="div col md-3">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Bahan baku<strong> berhasil </strong><?= $this->session->flashdata('flash'); ?>!
                                <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Biaya Produksi</h3>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form action="<?php echo site_url('pemakaian/btkl') ?>" method="post">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="no_pemakaian">No. Pemakaian:</label>
                                            <input type="text" hidden class="form-control" name="no_pemakaian" readonly value="<?php echo $_SESSION['no_pemakaian']; ?>"><br><?= $_SESSION['no_pemakaian']; ?>
                                            <!-- <?php echo "<b>" . form_error('no_pemakaian') . "</b>"; ?> -->
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal:</label>
                                            <div class="input-group date">
                                                <input type="date" hidden name="tanggal" readonly class="form-control" value="<?php echo $_SESSION['tanggal']; ?>" max="<?= date('Y-m-d') ?>" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div><?= $_SESSION['tanggal']; ?>
                                            <?php echo "<b>" . form_error('tanggal') . "</b>"; ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="id_bom">ID BOM:</label></label>
                                            <input readonly hidden class="form-control" name="id_bom" value="<?= $_SESSION['id_bom']; ?>">
                                            </input><br><?= $_SESSION['id_bom']; ?>
                                        </div>
                                    </div>
                                </div>
                                <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="container-fluid">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title mt-2">Daftar Bahan Baku</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Bahan Baku</th>
                                                <th class="text-center">Jumlah</th>
                                                <th class="text-center">Harga</th>
                                                <!-- <th class="text-center">Hapus</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($bom as $cacah) :
                                                echo "<tr>";
                                                echo "<td class='text-center'>" . $no++;
                                                "</td>";
                                                echo "<td><input hidden name='nama_bb' value='" . $cacah['nama_bb'] . "'>" . $cacah['nama_bb'] . "</td>";
                                                echo "<td><input hidden name='qty' value='" . $cacah['qty'] . "'>" . $cacah['qty'] . " " . $cacah['satuan_bb'] . "</td>";
                                                // echo "<td>" . format_rp($cacah['harga_bahan']) . "</td>";
                                                echo "<td align='center'>";
                                                echo "</td>";
                                                echo "</tr>";
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <div class="col-sm-12 text-center">
                                        <button onclick="location.href = '<?php echo site_url('pemakaian/btkl') ?>';" type="button" class="btn btn-success btn-sm">
                                            <span class="fas fa-check"></span>
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            < script src = "<?= base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js" >
        </script>
        <script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        </script>
        <!-- <script>
            $(document).ready(function() {
                $('#example').DataTable( {
                    "pagingType": "full_numbers"
                } );
            } );
            </script> -->
        <script>
            function deleteConfirm(url) {
                $('#btn-delete').attr('href', url);
                $('#deleteModal').modal();
            }
        </script>
        <!-- Logout Delete Confirmation-->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span span aria-hidden="true">X</span>
                        </button>
                    </div>
                    <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
                        <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>