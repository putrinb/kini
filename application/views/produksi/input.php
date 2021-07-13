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
                    <h3 class="card-title">Produksi</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form action="<?php echo site_url('pemakaian/input_form_detail') ?>" method="post">
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
                                        <label for="tanggal">Tanggal:</label>
                                        <div class="input-group date">
                                            <input type="date" hidden name="tgl" readonly class="form-control" value="<?php echo $_SESSION['tgl2']; ?>" />
                                        </div><?= date("d-m-Y", strtotime($_SESSION['tgl2'])); ?>
                                        <?php echo "<b>" . form_error('tanggal') . "</b>"; ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal Perhitungan:</label>
                                        <div class="input-group date">
                                            <input type="text" hidden name="waktu" readonly class="form-control" value="<?= date("Y-m-d H:i:s")?>" />
                                        </div><?= date("d-m-Y H:i:s"); ?>
                                        <?php echo "<b>" . form_error('tanggal') . "</b>"; ?>
                                    </div>
                                </div>
                            </div>

                            <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
</body>

</html>