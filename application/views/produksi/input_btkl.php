<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <!-- general form elements -->
            <form action="<?php echo site_url('produksi/btkl') ?>" method="post">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Biaya Produksi</h3>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="no_produksi">No. Pencatatan:</label>
                                        <input type="text" hidden class="form-control" name="no_produksi" readonly value="<?php echo $_SESSION['no_produksi']; ?>"><br><?= $_SESSION['no_produksi']; ?>
                                        <!-- <?php echo "<b>" . form_error('no_pemakaian') . "</b>"; ?> -->
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal Transaksi:</label>
                                        <div class="input-group date">
                                            <input type="date" hidden name="tanggal" readonly class="form-control" value="<?php echo $_SESSION['tgl2']; ?>" />
                                        </div><?= date("d-m-Y", strtotime($_SESSION['tgl2'])); ?>
                                        <?php echo "<b>" . form_error('tanggal') . "</b>"; ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal Perhitungan:</label>
                                        <div class="input-group date">
                                            <input type="text" hidden name="waktu" readonly class="form-control" value="<?= $_SESSION['waktu'] ?>" />
                                        </div><?= $_SESSION['waktu']; ?>
                                        <?php echo "<b>" . form_error('tanggal') . "</b>"; ?>
                                    </div>
                                </div>
                            </div>
                            <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Biaya Tenaga Kerja</h3>
                    </div>

                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-inline form-group mb-1">
                                        <label for="nama_bb">Gaji Perhari<span class="text-danger">*</span></label>
                                        <input type="text" id="harga_satuan" name="gaji" readonly min="0" value="<?= $jabatan; ?>" class="form-control ml-3 nominal" placeholder="000.000.000">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-inline form-group mb-1">
                                        <label for="person">Jumlah Karyawan<span class="text-danger">*</span></label>
                                        <input class="form-control ml-3" name="person" value="<?= set_value('person'); ?>" type="number" max_length="3" min="1" placeholder="1"></input>
                                    </div><?php echo "<b>" . form_error('person') . "</b>"; ?>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-inline form-group mb-1">
                                        <label for="sales">Rata-rata Penjualan Perbulan<span class="text-danger">*</span></label>
                                        <input class="form-control ml-3" name="sales" value="<?= set_value('sales'); ?>" type="number" min="1" placeholder="1"></input>
                                    </div><?php echo "<b>" . form_error('sales') . "</b>"; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button type="submit" class="btn btn-sm btn-success"><span class="fas fa-check"></span> Simpan</button>
                        </div>
                    </div>
            </form>
        </div>

        </div>

        <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery.mask.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.nominal').mask('000.000.000', {
                    reverse: true
                });
            });
        </script>
        </div>
    </section>