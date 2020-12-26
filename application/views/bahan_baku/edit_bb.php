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
                <h3 class="card-title">Edit Bahan Baku</h3>
              </div>
        
                <!-- form start -->
                <form action="" method="post" enctype="multipart/form-data" >
                    <div class="card-body">
                            <div class="form-group col-sm-12">
                                <input type="hidden" name="kode_bb" class="form-control" value="<?=$bahanbaku['kode_bb'];?>">
                                <label><b>Nama Bahan Baku</label><span class="text-danger">*</span> 
                                    <input type="text" name="nama_bb" maxlength="50" class="form-control" value="<?=$bahanbaku['nama_bb'];?>" placeholder="Masukan nama bahan baku">
                                    <?php echo "<b>".form_error('nama_bb')."</b>"; ?>
                            </div>
                            
                            <div class="form-group col-sm-12">
                                <label>Satuan</label><span class="text-danger">*</span>
                                <select name="satuan" class="form-control" id="satuan" placeholder="Pilih Satuan">
                                    <option value="">- Pilih Satuan -</option>
                                    <?php foreach( $satuan as $s) : ?>
                                        <?php if( $s == $bahanbaku['satuan'] ) : ?>
                                            <option value="<?= $s; ?>" selected><?= $s ;?></option>
                                        <?php else : ?>
                                            <option value="<?= $s; ?>"><?= $s ;?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo "<b>".form_error('satuan')."</b>"; ?>
                            </div>

                            <div class="form-group col-sm-12">
                                <label>Merk</label><span class="text-danger">*</span>
                                    <input type="text" name="merk" id="merk" class="form-control merk" maxlength="30" value="<?= $bahanbaku['merk'];?>" placeholder="ABC">
                                <?php echo "<b>".form_error('merk')."</b>"; ?>
                            </div>
                            <!-- <div class="form-group col-sm-12">
                                <label>Harga Satuan</label><span class="text-danger">*</span>
                                    <input type="text" id="harga_satuan" name="harga_satuan" class="form-control harga_satuan" value="<?=$bahanbaku['harga_satuan'];?>" placeholder="Masukan harga satuan">
                                <?php echo "<b>".form_error('harga_satuan')."</b>"; ?> 
                            </div> -->

                            <div class="form-group col-sm-12">
                                <label class="col-form-email">Stok Awal</label><span class="text-danger">*</span>
                                    <input type="number" name="stok_awal" min="0" class="form-control" value="<?=$bahanbaku['stok_awal'];?>" placeholder="Masukan stok awal">
                                <?php echo "<b>".form_error('stok_awal')."</b>"; ?> 
                            </div>
                    </div>

                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="<?=site_url('bahan_baku/view_data')?>" class="btn btn-danger"><span class="fa fa-times"></span> Batal
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
            $('.harga_satuan').mask('000.000.000.000.000', {reverse: true});
          });
        </script>
    </body>
</html>
