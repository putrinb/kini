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
                <h3 class="card-title">Tambah Produk</h3>
            </div>

                  <!-- /.card-header -->
                  <!-- form start -->
                    <form action="<?php echo site_url('produk/insert') ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                          <div class="row">
                                <div class="form-group col-sm-2">
                                    <label>ID Produk</label><span class="text-danger">*</span>
                                    <input name="id_produk" type="text" class="form-control" disabled value="<?php echo $id_produk;?>"/>
                                </div>
                                <div class="form-group col-sm-5">
                                  <label>Nama Produk</label><span class="text-danger">*</span>
                                  <input name="nama_produk" type="text" class="form-control" value="<?php echo set_value('nama_produk');?>" placeholder="Masukkan Produk"/>
                                  <?php echo "<b>".form_error('nama_produk')."</b>"; ?>
                                </div>
                              </div>
                            
                            <div class="row">
                              <div class="form-group col-sm-3">
                                  <p><strong>Gambar</strong></p>
                                  <div class="custom-file">
                                      <label class="custom-file-label" for="image">Upload Gambar</label>
                                          <input type="file" class="custom-file-input" id="image" name="image">
                                  </div>
                              </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <div class="text-right">
                                <a href="<?=site_url()?>/produk/view_data" class="btn btn-danger"><span class="fas fa-times"></span> Batal</a>
                                <button type="submit"class="btn btn-primary"><span class="fas fa-plus"></span> Tambah</button>
                            </div>
                        </div>
                    </form>

                      <!-- <script src="<?=base_url();?>assets/js/jquery.min.js"></script>
                      <script src="<?=base_url();?>assets/js/jquery.mask.min.js"></script> -->
                      <script>
                    // Add the following code if you want the name of the file appear on select
                    $(".custom-file-input").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                    });
                    </script>
                  </form>
                </div>
              </div>
        </section>
      </body>
    </html>