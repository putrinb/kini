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
                <h3 class="card-title">Form Tambah Supplier</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
              <?php echo form_open('supplier/insert');?>
                <div class="card-body">
                  <div class="form-group col-sm-12">
                    <label>Nama Supplier</label><span class="text-danger">*</span>
                    <input name="nama_supplier" type="text" class="form-control" value="<?php echo set_value('nama_supplier');?>" placeholder="CV Cahaya Baru">
                    <?php echo "<b>".form_error('nama_supplier')."</b>"; ?>
                  </div>
                  <div class="form-group col-sm-12">
                    <label>Alamat</label><span class="text-danger">*</span>
                    <textarea name="alamat" id="inputalamat" class="form-control" rows="3" placeholder="Jl. Manggis No. 3, Pekalongan"><?php echo set_value('alamat');?></textarea>
                    <?php echo "<b>".form_error('alamat')."</b>"; ?>
                  </div>
                  <div class="form-group col-sm-12">
                    <label>No. Telepon</label><span class="text-danger">*</span>
                    <input name="no_telp" type="text" class="form-control no_telp" value="<?php echo set_value('no_telp');?>" placeholder="0000-0000-0000">
                    <?php echo "<b>".form_error('no_telp')."</b>"; ?>
                  </div>
                  <div class="form-group col-sm-12">
                    <label>Email</label><span class="text-danger">*</span>
                    <input name="email" type="email" class="form-control" value="<?php echo set_value('email');?>" placeholder="example@mail.com">
                    <?php echo "<b>".form_error('email')."</b>"; ?>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <div class="text-right">
                      <a href="<?=site_url()?>/supplier/view_data" class="btn btn-danger"><span class="fas fa-times"></span> Batal</a>
                      <button type="submit"class="btn btn-primary"><span class="fas fa-plus"></span> Tambah</button>
                  </div>
                </div>
                  <script src="<?=base_url();?>assets/js/jquery.min.js"></script>
                  <script src="<?=base_url();?>assets/js/jquery.mask.min.js"></script>
                  <script type="text/javascript">
                  $(document).ready(function(){
                      // $('.date').mask('00/00/0000');
                      // $('.time').mask('00:00:00');
                      // $('.date_time').mask('00/00/0000 00:00:00');
                      $('.no_telp').mask('0000-0000-0000');
                      // $('.phone_with_ddd').mask('(00) 0000-0000');
                      // $('.phone_us').mask('(000) 000-0000');
                      // $('.mixed').mask('AAA 000-S0S');
                      //$('.harga_satuan').mask('000.000.000.000.000,00', {reverse: true});
                      // $('.money2').mask("#.##0,00", {reverse: true});
                      // $('.ip_address').mask('099.099.099.099');
                      // $('.percent').mask('##0,00%', {reverse: true});
                      // $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
                      // $('.credit_card').mask('0000 0000 0000 0000');
                      // $('.valid').mask('00/00');
                    });
                  </script>
              </form>
            </div>
          </div>
    </section>
  </body>
</html>