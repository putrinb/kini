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
                    <h3 class="card-title">Tambah Daftar Penggunaan</h3>
                </div>
                
                <?php echo form_open('operasional/add'); ?>
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Nama Penggunaan</label><span class="text-danger">*</span>
                                <input name="penggunaan" type="text" maxlength="50" class="form-control" value="<?php echo set_value('penggunaan'); ?>" placeholder="Masukkan Penggunaan">
                                <?php echo "<b>" . form_error('penggunaan') . "</b>"; ?>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Daya Penggunaan (watt)</label><span class="text-danger">*</span>
                                <input type="text" name="daya" id="watt" class="form-control watt" maxlength="30" value="<?php echo set_value('daya'); ?>" placeholder="65">
                                <?php echo "<b>" . form_error('daya') . "</b>"; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.card-body -->

                <div class="card-footer">
                    <div class="text-right">
                        <a href="<?= site_url() ?>/operasional/view_data" class="btn btn-danger"><span class="fas fa-times"></span> Batal</a>
                        <button type="submit" class="btn btn-primary"><span class="fas fa-check"></span> Simpan</button>
                    </div>
                </div>

                <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
                <script src="<?= base_url(); ?>assets/js/jquery.mask.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.watt').mask('000.000', {
                            reverse: true
                        });
                    });
                </script>
                </form>
            </div>
        </div>
    </section>
</body>

</html>