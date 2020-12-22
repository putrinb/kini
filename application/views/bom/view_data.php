<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini">
<div class="wrapper">   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php if( $this->session->flashdata('flash') ) : ?>
      <div class="div row mt-3">
          <div class="div col md-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              Data bom<strong> berhasil </strong><?=$this->session->flashdata('flash');?>!
              <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
            </div>
          </div>
      </div>
      <?php endif; ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title mt-2">Data Bill of Material</h3>
                  <div class="text-right">
                    <a href="<?=site_url('bom/add')?>" class="btn btn-info btn-sm">
                      <span class="fa fa-plus"></span> Tambah</a>
                  </div>
                </div>
              <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No. BOM</th>
                                    <th>Nama Produk</th>
                                    <!-- <th>No. Faktur</th> -->
                                    <!--<th class="text-center">Upload</th>-->
                                    <th>Detail</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no=1;
                                    foreach($data_bom as $cacah):
                                    echo "<tr>";
                                    echo "<td>".$no++;"</td>";
                                    echo "<td>".$cacah['id_bom']."</td>";
                                    // echo "<td align='center'>".$cacah['tanggal']."</td>";
                                    echo "<td>"."[".$cacah['id_produk']."] ".$cacah['nama_produk']."</td>";
                                    
                                ?>
                                    <td class="text-center">
                                        <button onclick="location.href = '<?php echo site_url('bom/view_data_detail/'.$cacah['id_bom'].'/'.$cacah['id_produk']) ?>'" type="button" class="btn btn-info btn-sm">
                                        <span class="fas fa-info-circle"></span> Detail
                                    </td>
                                    <td class="text-center">
                                        <!-- <button onclick="location.href = '<?php echo site_url('bom/edit_form/'.$cacah['id_bom'].'/'.$cacah['id_produk']) ?>'" type="button" class="btn btn-success btn-sm">
                                            <span class="fas fa-edit"></span> Ubah
                                        </button> -->
                                        <a onclick="deleteConfirm('<?php echo site_url('bom/delete_form/'.$cacah['id_bom'].'/'.$cacah['id_produk']) ?>')" href="#!" class="btn btn-danger btn-sm">
                                        <span class="fas fa-trash"></span> Hapus
                                        </a>
                                    </td>
                                <?php
                                    endforeach;
                                ?>
                            </tbody>
                        </table>
                        <!-- DataTables -->
                        <script>
                            <script src="<?=base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
                            <script src="<?=base_url();?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
                            <script src="<?=base_url();?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
                            <script src="<?=base_url();?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> 
                        </script>

                        <!-- Logout Delete Confirmation-->
                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">X</span>
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
                        </table>
                    </div>    
            </div>
        </div>
        </div>
    </section>
</div>
</body>
</html>