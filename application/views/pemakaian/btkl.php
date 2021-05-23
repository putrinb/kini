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

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Biaya Tenaga Kerja Langsung</h3>
                </div>
               
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-inline form-group mb-1">
                                        <label for="nama_bb">Gaji Perhari<span class="text-danger">*</span></label>
                                        <input type="text" id="harga_satuan" name="gaji" min="0" value="<?= set_value('gaji'); ?>" class="form-control ml-3 harga_satuan" placeholder="000.000.000.000.000">
                                    </div><?php echo "<b>" . form_error('gaji') . "</b>"; ?>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-inline form-group mb-1">
                                        <label for="day">Jumlah Hari<span class="text-danger">*</span></label>
                                        <input class="form-control form-inline ml-3" name="day" value="<?= set_value('day'); ?>" type="number" min="1" placeholder="1"></input>
                                    </div><?php echo "<b>" . form_error('day') . "</b>"; ?>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-inline form-group mb-1 mt-3">
                                        <label for="person">Jumlah Karyawan<span class="text-danger">*</span></label>
                                        <input class="form-control ml-3" name="person" value="<?= set_value('person'); ?>" type="number" min="1" placeholder="1"></input>
                                    </div><?php echo "<b>" . form_error('person') . "</b>"; ?>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-inline form-group mb-1 mt-3">
                                        <label for="sales">Rata-rata Penjualan Perhari<span class="text-danger">*</span></label>
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
                $('.harga_satuan').mask('000.000.000.000.000', {
                    reverse: true
                });
            });
        </script>
        </div>
    </section>