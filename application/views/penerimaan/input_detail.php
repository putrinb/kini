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
                        <form action="<?php echo site_url('penerimaan/input_form_detail') ?>" method="post"> 
                            <div class="row">
                                <div class="col-sm-3">
                                <!-- text input -->
                                    <div class="form-group">
                                        <label for="id_penerimaan">No. Penerimaan:</label>
                                        <input type="text" hidden class="form-control" name="id_penerimaan" readonly value="<?php echo $_SESSION['id_penerimaan']; ?>"><br><?=$_SESSION['id_penerimaan']; ?>
                                        <!-- <?php echo "<b>".form_error('id_penerimaan')."</b>"; ?> -->
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                <!-- text input -->
                                    <div class="form-group">
                                        <label for="nm_penerima">Nama Penerima:</label>
                                        <input type="text" hidden class="form-control" name="nm_penerima" readonly value="<?php echo $_SESSION['nm_penerima']; ?>"><br><?=$_SESSION['nm_penerima']; ?>
                                        <!-- <?php echo "<b>".form_error('nm_penerima')."</b>"; ?> -->
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                            <label for="tanggal">Tanggal:</label>
                                            <div class="input-group date">
                                                <input type="date" hidden name="tanggal" readonly class="form-control" value="<?php echo $_SESSION['tanggal']; ?>" max="<?=date('Y-m-d')?>"/>
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                            </div><?=$_SESSION['tanggal']; ?>
                                            <?php echo "<b>".form_error('tanggal')."</b>"; ?>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="id_pembelian">No. Faktur:</label>
                                        <input readonly hidden class="form-control" name="id_pembelian" value="<?= $_SESSION['id_pembelian'];?>">
                                        </input><br><?=$_SESSION['id_pembelian']; ?>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="nama_bb">Nama Bahan Baku
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" name="nama_bb">
                                        <option value="">- None -</option>
                                            <?php
                                            foreach($bb_pembelian as $row):
                                            ?>
                                            <option value="<?php echo $row['kode_barang']?>">[<?php echo $row['kode_barang']?>] <?php echo $row['nama_bb']?></option>
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
                                    <input class="form-control" name="qty" value="<?=set_value('qty');?>" type="number" min="1" placeholder="1"></input>
                                    <?php echo "<b>".form_error('qty')."</b>"; ?> 
                                </div>
                                </div>

                                <div class="col-sm-3">
                                <div class="form-group">
                                <label>Satuan</label><span class="text-danger">*</span>
                                <select name="satuan" class="form-control"  value=<?php echo set_value('satuan');?>"" id="satuan" placeholder="Pilih Satuan">
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

                                <div class="col-sm-3">
                                <div class="form-group">
                                <label>Harga Satuan</label><span class="text-danger">*</span>
                                    <input type="text" id="harga_satuan" name="harga_satuan" min="0" value="<?=set_value('harga_satuan');?>" class="form-control harga_satuan" placeholder="000.000.000.000.000">
                                <?php echo "<b>".form_error('harga_satuan')."</b>"; ?> 
                                </div>
                                </div>
                                <div class="col sm-4">
                                    <!-- text input -->
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan<span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="keterangan" value="<?php echo set_value("keterangan"); ?>" placeholder="Keterangan Barang"></textarea>
                                            <?php echo "<b>".form_error('keterangan')."</b>"; ?>
                                        </div>
                                    </div>  
                            </div>
                        </div>
                            <div class="card-footer">
                                <div class="text-center">
                                    <!-- <a href="<?=site_url()?>/pembelian/view_data" class="btn btn-danger"><span class="fas fa-times"></span> Batal</a> -->
                                        <button type="submit"class="btn btn-success"><span class="fas fa-plus"></span></button>
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

