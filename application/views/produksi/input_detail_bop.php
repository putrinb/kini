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
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data<strong> berhasil </strong><?=$this->session->flashdata('flash');?>!
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                    </div>
                </div>
            </div>
        <?php endif; ?>
            <div class="row">
                <div class="col-12">
                    <div class="card card-light">
                        <div class="card-header">
                            <h3 class="card-title mt-2">Detail Data</h3>
                        </div>
                        <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Jenis Penggunaan</th>
                                            <th class="text-center">Daya Penggunaan</th>
                                            <th class="text-center">Tarif Dasar Listrik</th>
                                            <th class="text-center">Lama</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $no=1;
                                        // foreach($data_bom as $cacah):
                                        //     echo "<tr>";
                                        //         echo "<td class='text-center'>".$no++;"</td>";
                                        //         echo "<td>".$cacah['nama_bb']."</td>";
                                        //         echo "<td>".$cacah['merk']."</td>";
                                        //         echo "<td class='text-center'>".$cacah['qty']."</td>";
                                        //         echo "<td>".$cacah['satuan_bb']."</td>";
                                        //         echo "<td align='center'>";
                                        //             ?>
                                        //                 <a onclick="deleteConfirm('<?php echo site_url('bom/delete_form_detail/'.$cacah['no_bom'].'/'.$cacah['id_bom'].'/'.$cacah['id_minum']) ?>')" href="#!" class="btn btn-danger btn-sm">
                                        //                     <span class="fas fa-trash"></span>
                                        //                 </a>
                                        //             <?php
                                        //         echo "</td>";
                                        //     echo "</tr>";
                                        // endforeach;
                                    ?>
                                    </tbody>
                                    
                                </table></div>
                                <div class="card-footer">
                                    <div class="col-sm-12 text-center">
                                        <button onclick="location.href = '<?php echo site_url('bom/selesai') ?>';" type="button" class="btn btn-info btn-sm">
                                        <span class="fas fa-check"></span>
                                                    Simpan
                                        </button>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
                <script src="<?=base_url();?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
                <script src="<?=base_url();?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
                <script src="<?=base_url();?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> 
            
            <script>
            function deleteConfirm(url)
            {
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