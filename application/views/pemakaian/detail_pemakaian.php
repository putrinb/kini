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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Biaya Produksi</h3>
              </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <form action="<?php echo site_url('pemakaian/input_form_detail') ?>" method="post"> 
                            <div class="row">
                                <div class="col-sm-4">                                  
                                    <div class="form-group">
                                        <label for="no_pemakaian">No. Pemakaian:</label>
                                            <input type="text" hidden class="form-control" name="no_pemakaian" readonly value="<?php echo $_SESSION['no_pemakaian']; ?>"><br><?=$_SESSION['no_pemakaian']; ?>
                                            <!-- <?php echo "<b>".form_error('no_pemakaian')."</b>"; ?> -->
                                    </div>
                                </div>

                                <div class="col-sm-4">
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
                                        
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="id_bom">ID BOM:</label></label>
                                        <input readonly hidden class="form-control" name="id_bom" value="<?= $_SESSION['id_bom'];?>">
                                        </input><br><?=$_SESSION['id_bom']; ?>
                                    </div>
                                </div>
                            </div>
                
                                <hr style="height:1px;border:none;color:#333;background-color:#333;" />  

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nama_bb">Nama Bahan Baku<span class="text-danger">*</span></label>
                                        <select class="form-control" class="text-center" name="nama_bb">
                                            <option value="">- None -</option>
                                                <?php foreach($bom as $row): ?>	
                                            <option value="<?php echo $row['kode_bb']?>"><?php echo "[ ".$row['kode_bb']." ] - ".$row['nama_bb']?></option>
                                                <?php endforeach; ?>
                                        </select><?php echo "<b>".form_error('nama_bb')."</b>"; ?>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="qty">Jumlah<span class="text-danger">*</span></label>
                                            <select class="form-control" class="text-center" name="qty">
                                                <option value="">- None -</option>
                                                    <?php foreach($bom as $row): ?>	
                                                        <option value="<?php echo $row['kode_bb']?>"><?php echo " ".$row['qty']." ".$row['satuan_bb']?></option>
                                                    <?php endforeach; ?>
                                            </select><?php echo "<b>".form_error('qty')."</b>"; ?>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                            <label>Harga Satuan</label><span class="text-danger">*</span>
                                                <input type="text" id="harga_satuan" name="harga" min="0" value="<?=set_value('harga');?>" class="form-control harga_satuan" placeholder="000.000.000.000.000">
                                            <?php echo "<b>".form_error('harga')."</b>"; ?> 
                                    </div>
                                </div>
                            </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="gaji">Gaji Perhari<span class="text-danger">*</span>
                                                </label>
                                                <input type="text" id="harga_satuan" name="gaji" min="0" value="<?=set_value('gaji');?>" class="form-control harga_satuan" placeholder="000.000.000.000.000">
                                            <?php echo "<b>".form_error('gaji')."</b>"; ?>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="day">Jumlah Hari<span class="text-danger">*</span></label>
                                                <input class="form-control" name="day" value="<?=set_value('day');?>" type="number" min="1" placeholder="1"></input>
                                                <?php echo "<b>".form_error('day')."</b>"; ?> 
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="person">Jumlah Karyawan<span class="text-danger">*</span></label>
                                                <input class="form-control" name="person" value="<?=set_value('person');?>" type="number" min="1" placeholder="1"></input>
                                                <?php echo "<b>".form_error('person')."</b>"; ?> 
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="sales">Rata-rata Penjualan Perhari<span class="text-danger">*</span></label>
                                                <input class="form-control" name="sales" value="<?=set_value('sales');?>" type="number" min="1" placeholder="1"></input>
                                                <?php echo "<b>".form_error('sales')."</b>"; ?> 
                                            </div>
                                        </div>
                                    </div>
                        
                            <div class="card-footer">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-sm btn-success"><span class="fas fa-plus"></span> Add</button>
                                </div>
                            </div>
                        </form>
                
                        <script src="<?=base_url();?>assets/js/jquery.min.js"></script>
                        <script src="<?=base_url();?>assets/js/jquery.mask.min.js"></script>
                        <script type="text/javascript">
                        $(document).ready(function(){
                            $('.harga_satuan').mask('000.000.000.000.000', {reverse: true});
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </body>
</html>

