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
                <h3 class="card-title">Penerimaan Bahan Baku</h3>
              </div>
              <!-- <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div> -->

                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="<?php echo site_url('penerimaan/add') ?>" method="post"> 
                            <div class="row">
                                <!-- <div class="col pt-2"> -->
                                <!-- text input -->
                                    <div class="col sm-4">
                                    <div class="form-group">
                                            <label for="id_penerimaan">No. Penerimaan</label>
                                            <input type="text" class="form-control" name="id_penerimaan" readonly value="<?php echo $id_penerimaan; ?>"/>
                                            <?php echo "<b>".form_error('id_penerimaan')."</b>"; ?>
                                        </div>
                                    </div>   
                            
                                    <div class="col sm-4">
                                    <!-- text input -->
                                        <div class="form-group">
                                            <label for="nm_penerima">Nama Penerima</label>
                                            <input type="text" class="form-control" name="nm_penerima" readonly value="<?php echo $nama; ?>" placeholder="Nama Penerima"/>
                                            <?php echo "<b>".form_error('nm_penerima')."</b>"; ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                                <label for="tanggal">Tanggal<span class="text-danger">*</span></label>
                                                <div class="input-group date">
                                                    <input type="date" name="tanggal" class="form-control " value="<?php echo set_value('tanggal'); ?>" min="<?=date('Y-m-d', strtotime('yesterday'))?>" max="<?=date('Y-m-d')?>"/>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                </div>
                                                <?php echo "<b>".form_error('tanggal')."</b>"; ?>
                                        </div>
                                </div>
                            </div>
                        </div>
                            <div class="card-footer">
                                <div class="text-center">
                                    <!-- <a href="<?=site_url()?>/penerimaan/view_data" class="btn btn-danger"><span class="fas fa-times"></span> Batal</a> -->
                                        <button type="submit"class="btn btn-success"><span class="fas fa-plus"></span> Tambah</button>
                                </div>
                            </div>
                        </form>
                    
        </div>
                        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
                        <script src="<?php echo base_url(); ?>assets/js/moment-with-locales.js"></script>
                        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
                        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
                        <script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.js"></script>
                        <script src="<?=base_url();?>assets/js/jquery.min.js"></script>
                        <script src="<?=base_url();?>assets/js/jquery.mask.min.js"></script>
                        <script type="text/javascript">
                            $(function () {
                                $('.datetimepicker').datetimepicker({
                                    format: 'YYYY-MM-DD HH:mm:ss',
                                });
                            });
                        </script>
                        <script type="text/javascript">
                        $(document).ready(function(){
                            $('.harga_satuan').mask('000.000.000.000.000', {reverse: true});
                        });
                        </script>
    </section>
    </body>
</html>

