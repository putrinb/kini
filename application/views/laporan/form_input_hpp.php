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
        <div class="container-fluid">
            <!-- general form elements -->
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Harga Pokok Penjualan</h3>

                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <!-- <small>Masukan Periode Kartu Stok</small> -->
                    <form action="<?php echo site_url('laporan/hpp') ?>" method="post">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="no_faktur">Bulan<span class="text-danger">*</span></label>
                                    <select class="form-control" name="bulan">
                                    <option value="">- None -</option>
                                    <?php
                                        foreach ($bulan as $row) :
                                        ?>
                                            <option value="<?php echo $row['bulan'] ?>"><?php echo format_bulan($row['bulan']) ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select> <?= form_error('bulan') ?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tahun">Tahun<span class="text-danger">*</span></label>
                                    <select class="form-control" name="tahun">
                                        <option value="">- None -</option>
                                        <?php
                                        foreach ($tahun as $row) :
                                        ?>
                                            <option value="<?php echo $row['tahun'] ?>"><?php echo $row['tahun'] ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select><?= form_error('tahun') ?>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="card-footer">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary">Proses</button>
                    </div>
                </div>
                </form>

            </div>
        </div>
    </section>
</body>

</html>