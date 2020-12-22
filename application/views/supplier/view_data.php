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
              Data supplier<strong> berhasil </strong><?=$this->session->flashdata('flash');?>!
              <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
            </div>
          </div>
      </div>
      <?php endif; ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Supplier</h3>
                  <div align="right">
                  <a href="<?=site_url('supplier/add')?>" class="btn btn-info btn-sm">
                    <span class="fa fa-plus"></span> Tambah</a>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead class="thead-light text-center">
                  <tr>
                    <th>ID Supplier</th>
                    <th>Nama Supplier</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Email</th>
                    <th>Aksi</th></th>
                  </tr>
                  </thead>

                  <!-- <tfoot>
                  <tr>
                    <th>ID Supplier</th>
                    <th>Nama Supplier</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Email</th>
                    <th>Aksi</th>
                  </tr>
                  </tfoot> -->

                  <tbody>
                  <tr>
                            <?php
                                $no=1;
                                foreach($supplier as $row):
                                echo "<tr>";
                                echo "<td>".$row['id_supplier']."</td>
                                <td>".$row['nama_supplier']."</td>
                                <td>".$row['alamat']."</td>
                                <td>".$row['no_telp']."</td>
                                <td>".$row['email']."</td>
                                <td align='center'>"
                            ?>

                                <a href="<?=site_url('supplier/edit_data/'.$row['id_supplier'])?>" class="btn btn-success btn-sm">
                                    <span class="fa fa-edit"></span>
                                </a>

                                <a onclick="deleteConfirm('<?=site_url('supplier/delete_data/'.$row['id_supplier'])?>')" class="btn btn-danger btn-sm" style="color:white">
                                    <span class="fa fa-trash"></span>
                                </a>
                                <?php
                                echo "</td>";
                                echo "</tr>";
                                endforeach;
                                ?>
                        </tr>
                  </tbody>
                </table>
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
              <!-- /.card-body -->
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
