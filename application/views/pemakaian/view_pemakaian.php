<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
  </head>
  <body>
    <div class="wrapper">   

    <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
            <?php if( $this->session->flashdata('flash') ) : ?>
            <div class="div row mt-3">
                <div class="div col md-3">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                    Bahan baku<strong> berhasil </strong><?=$this->session->flashdata('flash');?>!
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                    </div>
                </div>
            </div>
        <?php endif; ?>
            <div class="row">
                <div class="container-fluid">
                    <div class="col-12">
                        <div class="card card-light">
                            <div class="card-header">
                                <h3 class="card-title mt-2">Detail Data</h3>
                            </div>
                            <!-- /.card-header -->
                                <div class="card-body">
                                    <form action="<?php echo site_url('pemakaian/input_form_detail') ?>" method="post"> 
                                    <div class="row">
                                        <div class="col-sm-3">
                                        <!-- text input -->
                                            <div class="form-group">
                                                <label for="no_pemakaian">No. Pemakaian</label>
                                                <input type="text" class="form-control" name="no_pemakaian" readonly value="<?php echo $_SESSION['no_pemakaian']; ?>">
                                                <!-- <?php echo "<b>".form_error('no_pemakaian')."</b>"; ?> -->
                                            </div>
                                        </div>
                        
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                    <label for="tanggal">Tanggal</label>
                                                    <div class="input-group date">
                                                        <input type="date" name="tanggal" readonly class="form-control" value="<?php echo $_SESSION['tanggal']; ?>" max="<?=date('Y-m-d')?>"/>
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                            </span>
                                                    </div>
                                                    <?php echo "<b>".form_error('tanggal')."</b>"; ?>
                                            </div>
                                        </div>

                                        <!-- <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="nama_produk">ID Produk</label>
                                            </label>
                                            <input readonly class="form-control" name="nama_produk" value="<?= $_SESSION['id_produk'];?>">
                                            </input>
                                        </div>
                                        </div> -->

                                        <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="id_bom">ID BOM</label>
                                            </label>
                                            <input readonly class="form-control" name="id_bom" value="<?= $_SESSION['id_bom'];?>">
                                            </input>
                                        </div>
                                        </div>
                                    </div>
                                        <table class="table table-bordered table-hover mt-3">
                                            <thead>
                                                <tr class="text-center">
                                                    <th class="text-center">No.</th>
                                                    <th>ID Bahan Baku</th>
                                                    <th>Bahan Baku</th>
                                                    <!-- <th>Merk</th> -->
                                                    <th>Jumlah</th>
                                                    <th>Satuan</th>
                                                    <th>Harga</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no=1;
                                                foreach($bom as $cacah):
                                                    echo "<tr>";
                                                        echo "<td class='text-center'>".$no++;"</td>";
                                                        echo "<td><input name='kode_bb' type='text' hidden value='".$cacah['kode_bb']."' >".$cacah['kode_bb']."</td>";
                                                        echo "<td>".$cacah['nama_bb'];"</td>";
                                                        echo "<td><input name='qty' type='text' hidden value='".$cacah['qty']."' >".$cacah['qty']."</td>";
                                                        echo "<td><input name='satuan_bahan' type='text' hidden value='".$cacah['satuan_bb']."' >".$cacah['satuan_bb']."</td>";
                                                        echo "<td class='text-center'><input name='harga' class='form-control harga' type='text' min='0' style='width:'100px'' value='".set_value('harga')."'>".form_error('harga').
                                                        "</input></td>";
                                                        // echo "<td>".$cacah['qty']*$cacah['satuan_bahan']."</td>";
                                                        // echo "<td>".format_rp($cacah['harga_satuan'])."</td>";
                                                        // echo "<td>".format_rp($cacah['qty']*$cacah['harga_satuan'])."</td>";
                                                        // echo "<td>".$cacah['ket']."</td>";
                                                        echo "<td align='center'>";
                                                            ?>
                                                                <!-- <a onclick="deleteConfirm('<?php echo site_url('pemakaian/delete_form_detail/'.$cacah['id'].'/'.$cacah['no_pemakaian'].'/'.$cacah['id_bom']) ?>')" href="#!" class="btn btn-danger btn-sm">
                                                                    <span class="fas fa-trash"></span>
                                                                </a> -->
                                                            <?php
                                                        echo "</td>";
                                                    echo "</tr>";
                                                endforeach;
                                            ?>
                                            </tbody>
                                        </table></div>
                                    <div class="card-footer">
                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-success btn-sm">
                                            <span class="fas fa-sync"></span>
                                                        Proses
                                            </button>
                                            <button onclick="location.href = '<?php echo site_url('pemakaian/input_form_detail') ?>';" type="button" class="btn btn-info btn-sm">
                                            <span class="fas fa-check"></span>
                                                        Selesai
                                            </button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
        </section>
                <script src="<?=base_url();?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
                <script src="<?=base_url();?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
                <script src="<?=base_url();?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
                <script src="<?=base_url();?>assets/js/jquery.min.js"></script>
                <script src="<?=base_url();?>assets/js/jquery.mask.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function(){
                    $('.harga').mask('000.000.000.000.000', {reverse: true});
                    });
                </script>        
            <!-- <script>
            $(document).ready(function() {
                $('#example').DataTable( {
                    "pagingType": "full_numbers"
                } );
            } );
            </script> -->
            <script>
            function deleteConfirm(url){
                $('#btn-delete').attr('href', url);
                $('#deleteModal').modal();
            }
            </script>
            <!-- Logout Delete Confirmation-->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span span aria-hidden="true">X</span>
                                </button>
                        </div>
                        <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
                                    <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
                            </div>
                    </div>
                </div>
            </div>
    </div>
</body>
</html>