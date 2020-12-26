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
                <h3 class="card-title">Edit Produk</h3>
            </div>

                  <!-- /.card-header -->
                  <!-- form start -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                          <div class="row">
                                <div class="form-group col-sm-2">
                                    <label>ID Produk</label><span class="text-danger">*</span>
                                    <input name="id_produk" type="text" class="form-control" readonly value="<?php echo $produk['id_produk'];?>"/>
                                </div>

                                <div class="form-group col-sm-5">
                                  <label>ID BOM</label></span>
                                  <input name="id_bom" type="text" class="form-control" disabled value="<?php echo $produk['id_bom'];?>"/>
                                </div>

                                <div class="form-group col-sm-5">
                                  <label>Nama Produk</label><span class="text-danger">*</span>
                                  <input name="nama_produk" type="text" class="form-control" maxlength="50" value="<?php echo $produk['nama_produk'];?>" placeholder="Masukkan Produk"/>
                                  <?php echo "<b>".form_error('nama_produk')."</b>"; ?>
                                </div>
                              </div>
                            
                            <div class="row">
                              <div class="form-group col-sm-3">
                                  <strong>Gambar</strong><small> (max. 1 MB)</small>
                                  <div class="custom-file">
                                      <label class="custom-file-label" for="image">Upload Gambar</label>
                                          <input type="file" class="custom-file-input" id="image" name="image">
                                          <input type="hidden" name="old_image" value="<?php echo $produk['gambar']; ?>" />
                                  </div>
                              </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <div class="text-right">
                                <a href="<?=site_url()?>/produk/view_data" class="btn btn-danger"><span class="fas fa-times"></span> Batal</a>
                                <button type="submit"class="btn btn-primary"><span class="fas fa-plus"></span> Simpan</button>
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