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
                <h3 class="card-title">Tambah<i>Chart of Account</i></h3>
              </div>

                  <!-- /.card-header
                  <div class="card-body"> -->

                  <!-- /.card-header -->
                  <!-- form start -->
              <?php echo form_open('coa/insert');?>
                <div class="card-body">
                  <div class="form-group col-sm-12">
                      <label>Kode Akun</label><span class="text-danger">*</span>
                      <input name="no_akun" type="text" class="form-control" value="<?php echo set_value('no_akun');?>" placeholder="Masukkan Kode Akun">
                      <?php echo "<b>".form_error('no_akun')."</b>"; ?>
                  </div>
                  <div class="form-group col-sm-12">
                      <label>Nama Akun</label><span class="text-danger">*</span>
                      <input name="nama_akun" type="text" class="form-control" value="<?php echo set_value('nama_akun');?>" placeholder="Masukkan Nama Akun">
                      <?php echo "<b>".form_error('nama_akun')."</b>"; ?>
                  </div>
                  <div class="form-group col-sm-12">
                      <label>Header Akun</label><span class="text-danger">*</span>
                      <input type="text" name="header_akun" class="form-control" placeholder="Masukkan Header Akun"><?php echo set_value('header_akun');?></input>
                      <?php echo "<b>".form_error('header_akun')."</b>"; ?>
                  </div>
                </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <div class="text-right">
                        <a href="<?=site_url()?>/coa/view_data" class="btn btn-danger"><span class="fas fa-times"></span> Batal</a>
                        <button type="submit"class="btn btn-primary"><span class="fas fa-plus"></span> Tambah</button>
                      </div>
                  </div>
                
              </form>
            </div>
      </div></section>
      </body>
    </html>