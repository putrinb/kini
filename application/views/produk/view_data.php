<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini">
<div class="wrapper">   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php if( $this->session->flashdata('flash') ) : ?>
      <div class="div row mt-2">
          <div class="div col md-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              Data produk<strong> berhasil </strong><?=$this->session->flashdata('flash');?>!
              <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
            </div>
          </div>
      </div>
      <?php endif; ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title mt-2">Data Produk</h3>
                  <div class="text-right">
                    <a href="<?=site_url('produk/add')?>" class="btn btn-info btn-sm">
                      <span class="fa fa-plus"></span> Tambah</a>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead class="text-center">
                  <tr>
                    <th class="text-center">No</th>
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>ID BOM</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>

                  <tbody>
                  
                            <?php
                                $no=1;
                                foreach($data_produk as $row):
                            ?>
                            <tr>
                              <td class="text-center">
                              <?= $no; ?>
                              </td>
                              <td class="text-center">
                                  <?= $row['id_produk']; ?>
                              </td>
                              <td class="text-left">
                                  <?= $row['nama_produk']; ?>
                              </td>

                              <td class="text-center">
                                  <?= $row['id_bom']; ?>
                              </td>

                              <td class="text-center">
                              <a id="image" href="<?php echo base_url('upload/produk/'.$row['gambar']) ?>" class="perbesar">
                                <img alt="image" src="<?php echo base_url('upload/produk/'.$row['gambar']) ?>" class="img-thumbnail" width="64" /></a>
                              </td>

                              <td class="text-center">
                                <a href="<?=site_url('produk/edit_data/'.$row['id_produk'])?>" class="btn btn-success btn-sm">
                                    <span class="fa fa-edit"></span>
                                </a>

                                <a onclick="deleteConfirm('<?=site_url('produk/delete_data/'.$row['id_produk'])?>')" class="btn btn-danger btn-sm" style="color:white">
                                    <span class="fa fa-trash"></span>
                                </a>
                            </td>
                                </tr>
                            
                           

                            
                                <?php
                                $no++;
                                endforeach;
                                ?>
                      
                  </tbody>
                </table>
              </div>
              <script src="<?= base_url('assets/jquery/jquery.fancybox.js') ?>"></script>
                <script>
                  function deleteConfirm(url){
                    $('#btn-delete').attr('href', url);
                    $('#deleteModal').modal();
                  }
                  </script>
                  <script>
                            $(function () {
                                $("#example1").DataTable({
                                "responsive": true,
                                "autoWidth": false,
                                });
                                $('#example2').DataTable({
                                "paging": true,
                                "lengthChange": false,
                                "searching": false,
                                "ordering": true,
                                "info": true,
                                "autoWidth": false,
                                "responsive": true,
                                });
                            });
                        </script>
                  <script>
                  $(document).ready(function() {
                      $(".perbesar").fancybox();
                  } );
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
            <!-- /.card -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</body>
</html>
