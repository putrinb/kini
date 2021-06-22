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
                <h3 class="card-title">Buat <i>Bill of Material</i></h3>
                <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
              </div>
              

                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="<?php echo site_url('bom/input_form_detail') ?>" method="post"> 
                            <div class="row">
                                <div class="col-6">
                                <!-- text input -->
                                    <div class="form-group">
                                        <label for="id_bom">No. BOM</label>
                                        <input type="text" class="form-control" name="id_bom" readonly value="<?php echo $_SESSION['id_bom']; ?>">
                                        <!-- <?php echo "<b>".form_error('id_bom')."</b>"; ?> -->
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="id_produk">ID Produk
                                            <!-- <span class="text-danger">*</span> -->
                                        </label>
                                    <input readonly class="form-control" name="id_produk" value="<?php echo $_SESSION['id_produk'];?>">
                                    </input>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nama_bb">Nama Bahan Baku
                                            <!-- <span class="text-danger">*</span> -->
                                        </label>
                                        <select class="form-control" name="nama_bb">
                                        <option value="">- None -</option>
                                            <?php
                                            foreach($bahanbaku as $row):
                                            ?>
                                            <option value="<?php echo $row['kode_bb']?>"><?php echo $row['nama_bb']?> - <?php echo $row['merk']?></option>
                                                <?php
                                                endforeach;
                                                ?>
                                        </select><?php echo "<b>".form_error('nama_bb')."</b>"; ?>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qty">Jumlah
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control" name="qty" value="<?=set_value('qty');?>" type="number" min="1" placeholder="1"></input>
                                    <?php echo "<b>".form_error('qty')."</b>"; ?> 
                                </div>
                                </div>

                                <div class="col-md-4">
                                <div class="form-group">
                                <label>Satuan</label><span class="text-danger">*</span>
                                <select name="satuan" class="form-control"  value="<?php echo set_value('satuan');?>" id="satuan" placeholder="Pilih Satuan">
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
                            </div>
                        </div>
                            <div class="card-footer">
                                <div class="text-center">
                                    <!-- <a href="<?=site_url('')?>/pembelian/view_data" class="btn btn-danger"><span class="fas fa-times"></span> Batal</a> -->
                                        <button type="submit"class="btn btn-success"><span class="fas fa-plus"></span> Tambah</button>
                                </div>
                            </div>
                        </form>
                    
        </div>
                        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
                        <script src="<?php echo base_url(); ?>assets/js/moment-with-locales.js"></script>
                        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
                        <script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.js"></script>
                        <script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>
                        <script src="<?=base_url();?>assets/js/jquery.min.js"></script>
                        <script src="<?=base_url();?>assets/js/jquery.mask.min.js"></script>
    </section>
    </body>
</html>