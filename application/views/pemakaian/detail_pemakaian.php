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
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
              </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="<?php echo site_url('pemakaian/input_form_detail') ?>" method="post"> 
                                <div class="row">
                                    <div class="col-sm-4">
                                    <!-- text input -->
                                        <div class="form-group">
                                            <label for="no_pemakaian">No. Pemakaian<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="no_pemakaian" readonly value="<?php echo $_SESSION['no_pemakaian']; ?>">
                                            <!-- <?php echo "<b>".form_error('no_pemakaian')."</b>"; ?> -->
                                        </div>
                                    </div>
                    
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                                <label for="tanggal">Tanggal<span class="text-danger">*</span></label>
                                                <div class="input-group date">
                                                    <input type="date" name="tanggal" readonly class="form-control" value="<?php echo $_SESSION['tanggal']; ?>" max="<?=date('Y-m-d')?>"/>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                </div>
                                                <?php echo "<b>".form_error('tanggal')."</b>"; ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="id_bom">ID BOM</label><span class="text-danger">*</span>
                                            </label>
                                            <input readonly class="form-control" name="id_bom" value="<?= $_SESSION['id_bom'];?>">
                                            </input>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="nama_bb">Nama Bahan Baku
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" class="text-center" name="nama_bb">
                                                <option value="">- None -</option>
                                                <?php
                                                    foreach($bom as $row):
                                                        ?>	
                                                            <option value="<?php echo $row['kode_bb']?>"><?php echo "[ ".$row['kode_bb']." ] - ".$row['nama_bb']?></option>
                                                        <?php
                                                    endforeach;
                                                ?>
                                            </select><?php echo "<b>".form_error('nama_bb')."</b>"; ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="qty">Jumlah
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input class="form-control" hidden name="qty" value="<?=set_value('qty');?>" type="number" min="1" placeholder="1"></input>
                                            <?php echo "<b>".form_error('qty')."</b>"; ?> 
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Satuan</label><span class="text-danger">*</span>
                                            <select name="satuan" hidden class="form-control"  value=<?php echo set_value('satuan');?>"" id="satuan" placeholder="Pilih Satuan">
                                                <option value="">- None -</option>
                                                <?php foreach( $satuan as $s) : ?>
                                                    <?php if( $s == $bahanbaku['satuan'] ) : ?>
                                                        <option value="<?= $s; ?>" selected><?= $s ;?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $s; ?>"><?= $s ;?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select><?php echo "<b>".form_error('satuan')."</b>"; ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                        <label>Harga Satuan</label><span class="text-danger">*</span>
                                            <input type="text" id="harga_satuan" name="harga" min="0" value="<?=set_value('harga');?>" class="form-control harga_satuan" placeholder="000.000.000.000.000">
                                        <?php echo "<b>".form_error('harga')."</b>"; ?> 
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                        <!-- <a href="<?=site_url()?>/pembelian/view_data" class="btn btn-danger"><span class="fas fa-times"></span> Batal</a> -->
                            <button type="submit" class="btn btn-success"><span class="fas fa-plus"></span> Add</button>
                        </div>
                    </div>
                    </form>
                        
                    
        </div>
                        <!-- <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script> -->
                        <script src="<?php echo base_url(); ?>assets/js/moment-with-locales.js"></script>
                        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
                        <script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.js"></script>
                        <script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>
                        <script type="text/javascript">
                        $(document).ready(function(){
                            $('.tanggal').mask('00/00/0000 00:00:00');
                        });
                        </script>
                        <script src="<?=base_url();?>assets/js/jquery.min.js"></script>
                        <script src="<?=base_url();?>assets/js/jquery.mask.min.js"></script>
                        <script type="text/javascript">
                        $(document).ready(function(){
                            $('.harga_satuan').mask('000.000.000.000.000', {reverse: true});
                        });
                        </script>
    </section>
    </body>
</html>

