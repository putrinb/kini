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
                <h3 class="card-title">Form Edit Supplier</h3>
              </div>
                <?php
                    foreach($data_form_input as $row):
                        $id_supplier = $row['id_supplier'];
                        $nama_supplier = $row['nama_supplier'];
                        $alamat = $row['alamat'];
                        $no_telp = $row['no_telp'];
                        $email = $row['email'];
                    endforeach;
                ?>
                <!-- form start -->
                <form action="<?php echo site_url('supplier/edit_data/'.$id_supplier) ?>" method="post" enctype="multipart/form-data" >
                    <div class="card-body">
                            <div class="form-group col-sm-12">
                                <input type="hidden" name="id_supplier" class="form-control" value="<?=$id_supplier;?>">
                                <label>Nama Supplier</label><span class="text-danger">*</span>
                                <?php echo "<b>".form_error('nama_supplier')."</b>"; ?> 
                                    <input type="text" name="nama_supplier" class="form-control" value="<?=$nama_supplier;?>" placeholder="cth. PT Tri Cipta Teknologi">
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Alamat</label><span class="text-danger">*</span>
                                <textarea name="alamat" id="inputalamat" class="form-control" rows="3"><?php echo $alamat;?></textarea>
                                <?php echo "<b>".form_error('alamat')."</b>"; ?>
                            </div>
                            <div class="form-group col-sm-12">
                                <label>No. Telepon</label><span class="text-danger">*</span>
                                <?php echo "<b>".form_error('no_telp')."</b>"; ?> 
                                    <input type="text" name="no_telp" class="form-control no_telp" value="<?=$no_telp;?>" placeholder="0000-0000-0000">
                            </div>

                            <div class="form-group col-sm-12">
                                <label class="col-form-email">Email</label><span class="text-danger">*</span>
                                <?php echo "<b>".form_error('email')."</b>"; ?> 
                                    <input type="text" name="email" class="form-control" value="<?=$email;?>" placeholder="cth. nama@domain.com">
                            </div>

                    </div>

                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="<?=site_url('supplier/view_data')?>" class="btn btn-danger"><span class="fa fa-times"></span> Batal
                                    </a>
                                    <button type="submit"class="btn btn-primary"><span class="fa fa-check"></span> Simpan</button>
                                </div>
                            </div>
                        
                    
                </form>
            </div>
        </div>
    </section>
        <!-- /.card -->
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
  </body>
</html>