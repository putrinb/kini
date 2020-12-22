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
                <h3 class="card-title">Tambah Bahan Baku</h3>
              </div>

                  <!-- /.card-header
                  <div class="card-body"> -->

                  <!-- /.card-header -->
                  <!-- form start -->
                    <?php echo form_open('bahan_baku/insert');?>
                      <div class="card-body">
                        <div class="form-group col-sm-12">
                          <label>Nama Bahan Baku</label><span class="text-danger">*</span>
                          <input name="nama_bb" type="text" class="form-control" value="<?php echo set_value('nama_bb');?>" placeholder="Masukkan Bahan Baku">
                          <?php echo "<b>".form_error('nama_bb')."</b>"; ?>
                        </div>
                        
                        <div class="form-group col-sm-12">
                          <label>Satuan</label><span class="text-danger">*</span>
                          <?php echo "<b>".form_error('satuan')."</b>"; ?>
                          <select name="satuan" class="form-control" value="<?php echo set_value('satuan');?>" placeholder="Pilih Satuan">
                              <option value="Kilogram (Kg)">Kilogram (Kg)</option>
                              <option value="Liter (L)">Liter (L)</option>
                              <option value="Gram (Gr)">Gram (Gr)</option>
                              <option value="Kaleng">Kaleng</option>
                              <option value="Pcs">Pieces (Pcs)</option>
                              <option value="Pack">Pack</option>
                              <option value="Balok">Balok</option>
                          </select>
                        </div>
                        
                        <div class="form-group col-sm-12">
                          <label>Merk</label><span class="text-danger">*</span>
                          <input type="text" name="merk" id="merk" class="form-control merk" value="<?php echo set_value('merk');?>" placeholder="ABC">
                          <?php echo "<b>".form_error('merk')."</b>"; ?>
                        </div>
                        
                        <div class="form-group col-sm-12">
                          <label>Stok Awal</label><span class="text-danger">*</span>
                          <input name="stok_awal" type="number" class="form-control" value="<?php echo set_value('stok_awal');?>" placeholder="Masukkan Stok Awal" min="0">
                          <?php echo "<b>".form_error('stok_awal')."</b>"; ?>
                        </div>
                      </div>
                      
                      <!-- /.card-body -->

                      <div class="card-footer">
                        <div class="text-right">
                            <a href="<?=site_url()?>/bahan_baku/view_data" class="btn btn-danger"><span class="fas fa-times"></span> Batal</a>
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
                          // $('.no_telp').mask('0000-0000-0000');
                          // $('.phone_with_ddd').mask('(00) 0000-0000');
                          // $('.phone_us').mask('(000) 000-0000');
                          // $('.mixed').mask('AAA 000-S0S');
                          $('.harga_satuan').mask('000.000.000.000.000,00', {reverse: true});
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