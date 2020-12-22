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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mt-2">Detail Data</h3>
                        </div>
                        <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Bahan Baku</th>
                                            <th class="text-center">Merk</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">Satuan</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Keterangan</th>
                                            <th class="text-center">Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $no=1;
                                        foreach($penerimaan as $cacah):
                                            echo "<tr>";
                                                echo "<td class='text-center'>".$no++;"</td>";
                                                echo "<td>"."[".$cacah['kode_bb']."] ".$cacah['nama_bb']."</td>";
                                                echo "<td>".$cacah['merk']."</td>";
                                                echo "<td>".$cacah['qty']."</td>";
                                                echo "<td>".$cacah['satuan']."</td>";
                                                echo "<td>".format_rp($cacah['harga_satuan'])."</td>";
                                                echo "<td>".format_rp($cacah['qty']*$cacah['harga_satuan'])."</td>";
                                                echo "<td>".$cacah['ket']."</td>";
                                                echo "<td align='center'>";
                                                    ?>
                                                        <a onclick="deleteConfirm('<?php echo site_url('penerimaan/delete_form_detail/'.$cacah['no_penerimaan'].'/'.$cacah['id_penerimaan'].'/'.$cacah['id_pembelian']) ?>')" href="#!" class="btn btn-danger btn-sm">
                                                            <span class="fas fa-trash"></span>
                                                        </a>
                                                    <?php
                                                echo "</td>";
                                            echo "</tr>";
                                        endforeach;
                                    ?>
                                    </tbody>
                                </table></div>
                                <div class="card-footer">
                                    <div class="col-sm-12 text-center">
                                        <button onclick="location.href = '<?php echo site_url('penerimaan/selesai') ?>';" type="button" class="btn btn-info btn-sm">
                                        <span class="fas fa-check"></span>
                                                    Selesai
                                        </button>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
            <script>
                <script src="<?=base_url();?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
                <script src="<?=base_url();?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
                <script src="<?=base_url();?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> 
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