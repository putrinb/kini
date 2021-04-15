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
                <h3 class="card-title">Pemakaian Bahan Baku</h3>
                <div class="card-tools">
                      <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button> -->
                      <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                    </div>
              </div>
              

                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="<?php echo site_url('pemakaian/add') ?>" method="post"> 
                            <div class="row">
                                <!-- <div class="col pt-2"> -->
                                <!-- text input -->
                                    <div class="col sm-4">
                                    <div class="form-group">
                                            <label for="no_pemakaian">No. <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="no_pemakaian" readonly value="<?php echo $no_pemakaian; ?>"/>
                                            <!-- <?php echo "<b>".form_error('no_pemakaian')."</b>"; ?> -->
                                        </div>
                                    </div>   
                            
                                    <!-- <div class="col sm-6">
                                        <div class="form-group">
                                            <label for="nm_pegawai">Nama Pegawai<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nm_pegawai" value="<?php echo set_value('nm_pegawai'); ?>" placeholder="Nama Pegawai">
                                            </input>
                                            <?php echo "<b>".form_error('nm_pegawai')."</b>"; ?>
                                        </div>
                                    </div> -->

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                                <label for="tanggal">Tanggal<span class="text-danger">*</span></label>
                                                    <input type="date" id="tanggal" name="tanggal" class="form-control tanggal" value="<?=set_value('tanggal');?>" max="<?=date('Y-m-d');?>">  
                                                    </input>
                                                <?php echo "<b>".form_error('tanggal')."</b>"; ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="id_bom">ID BOM
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" name="id_bom" value="<?=set_value('id_bom');?>">
                                                <option value="">- Pilih ID BOM -</option>
                                                    <?php
                                                        foreach($bom as $row):
                                                    ?>
                                                <option value="<?php echo $row['id_bom']?>">[<?php echo $row['id_bom']?>] <?php echo $row['nama_produk']?></option>
                                                    <?php
                                                        endforeach;
                                                    ?>
                                        </select><?php echo "<b>".form_error('id_bom')."</b>"; ?>
                                        </div>
                                    </div>
                            </div>
                        </div>
                            <div class="card-footer">
                                <div class="text-center">
                                    <!-- <a href="<?=site_url()?>/penerimaan/view_data" class="btn btn-danger"><span class="fas fa-times"></span> Batal</a> -->
                                        <button type="submit" class="btn btn-success"><span class="fas fa-plus"></span> Tambah</button>
                                </div>
                            </div>
                        </form>
                    
        </div>
                        <script src="<?=base_url();?>assets/js/jquery.min.js"></script>
                        <script src="<?=base_url();?>assets/js/moment-with-locales.js"></script>
                        <script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
                        <script src="<?=base_url();?>assets/js/bootstrap-datetimepicker.js"></script>
                        <script src="<?=base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
                        <script src="<?=base_url();?>assets/js/jquery.min.js"></script>
                        <script src="<?=base_url();?>assets/js/jquery.mask.min.js"></script>
                        <script type="text/javascript">
                        $(document).ready(function(){
                            $('.harga').mask('000.000.000.000.000', {reverse: true});
                        });
                        </script>
                        <script type="text/javascript">
                        $(function () {
                        $('#tanggal').datetimepicker({
                            format: 'YYYY-MM-DD HH:mm:ss'
                        });
                        });
                        </script>
                        
    </section>
    </body>
</html>

