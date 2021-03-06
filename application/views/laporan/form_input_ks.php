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
                    <h3 class="card-title">Kartu Stok</h3>

                </div>
                <!-- <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div> -->

                <!-- /.card-header -->
                <div class="card-body">
                    <!-- <small>Masukan Periode Kartu Stok</small> -->
                    <form action="<?php echo site_url('laporan/KartuStok') ?>" method="post">

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="no_faktur">Bulan<span class="text-danger">*</span></label>
                                    <select class="form-control" name="bulan">
                                        <option value="">- None -</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select> <?= form_error('bulan') ?>
                                </div>
                            </div>

                            <div class="col-sm-4">
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

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="kode_bb">Bahan Baku<span class="text-danger">*</span></label>
                                    <select class="form-control" name="kode_bb">
                                        <option value="">- None -</option>
                                        <?php
                                        foreach ($bb as $row) :
                                        ?>
                                            <option value="<?php echo $row['kode'] ?>"><?php echo $row['bb'] ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select><?= form_error('kode_bb') ?>
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