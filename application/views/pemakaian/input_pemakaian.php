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
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Produksi</h3>
                    <div class="card-tools">
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button> -->
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                    </div>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <form action="<?php echo site_url('produksi/create') ?>" method="post">
                        <div class="row">
                            <!-- <div class="col pt-2"> -->
                            <!-- text input -->
                            <div class="col sm-6">
                                <div class="form-group">
                                    <label for="no_pemakaian">No. Produksi<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="no_produksi" readonly value="<?php echo $no_produksi; ?>" />
                                    <!-- <?php echo "<b>" . form_error('no_pemakaian') . "</b>"; ?> -->
                                </div>
                            </div>

                            <div class="col sm-6">
                                <div class="form-group">
                                    <label for="no_nota">No. Nota<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="no_nota" readonly value="<?php echo $_SESSION['no_nota']; ?>" />
                                    <!-- <?php echo "<b>" . form_error('no_pemakaian') . "</b>"; ?> -->
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tanggal">Waktu Produksi<span class="text-danger">*</span></label>
                                    <input type="datetime-local" id="tanggal" name="tanggal" class="form-control tanggal" value="<?= set_value('tanggal'); ?>" max="<?= date('Y-m-d H:i:s'); ?>">
                                    </input>
                                    <?php echo "<b>" . form_error('tanggal') . "</b>"; ?>
                                </div>
                            </div>

                            <!-- <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="no_nota">No. Pesanan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" name="no_nota" value="<?= set_value('no_nota'); ?>">
                                                <option value="">- Pilih No. Pesanan -</option>
                                                    <?php
                                                    foreach ($order as $row) :
                                                    ?>
                                                <option value="<?php echo $row['no_nota'] ?>">[<?php echo $row['no_nota'] ?>]</option>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                            </select><?php echo "<b>" . form_error('no_nota') . "</b>"; ?>
                                        </div>
                                    </div> -->
                        </div>
                </div>
                <div class="card-footer">
                    <div class="text-center">
                        <!-- <a href="<?= site_url() ?>/penerimaan/view_data" class="btn btn-danger"><span class="fas fa-times"></span> Batal</a> -->
                        <button type="submit" class="btn btn-success"><span class="fas fa-plus"></span> Tambah</button>
                    </div>
                </div>
                </form>

            </div>
            <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/moment-with-locales.js"></script>
            <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/bootstrap-datetimepicker.js"></script>
            <script src="<?= base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery.mask.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('.harga').mask('000.000.000.000.000', {
                        reverse: true
                    });
                });
            </script>
            <script type="text/javascript">
                $(function() {
                    $('#tanggal').datetimepicker({
                        format: 'YYYY-MM-DD HH:mm:ss'
                    });
                });
            </script>

    </section>
</body>

</html>