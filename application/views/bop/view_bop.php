<div class="wrapper">  

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php if( $this->session->flashdata('flash') ) : ?>
          <div class="div row mt-2">
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title mt-2">Daftar Operasional</h3>
                  <div class="text-right">
                    <a href="<?=site_url('operasional/add')?>" class="btn btn-info btn-sm">
                      <span class="fa fa-plus"></span> Tambah</a>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th>No.</th>
                                    <th>ID</th>
                                    <th>Nama Penggunaan</th>
                                    <th>Daya Penggunaan (watt)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no=1;
                                    foreach($list as $cacah):
                                    echo "<tr>";
                                    echo "<td class='text-center'>".$no++;"</td>";
                                    echo "<td>".$cacah['id']."</td>";                                    
                                    echo "<td>".$cacah['penggunaan']."</td>";                                    
                                    echo "<td>".$cacah['daya_watt']."</td>";
                                ?>
                                    <td class="text-center">
                                        <button onclick="location.href = '<?php echo site_url('operasional/edit_data/'.$cacah['id']) ?>'" type="button" class="btn btn-info btn-sm">
                                            <span class="fas fa-edit"></span>
                                        </button>
                                          <!-- <a onclick="deleteConfirm('<?=site_url('bahan_baku/delete_data/'.$cacah['id'])?>')" class="btn btn-danger btn-sm" style="color:white">
                                        <span class="fa fa-trash"></span>
                                        </a> -->
                                        <?php
                                        
                                    echo "</td>";
                                    echo "</tr>";
                                    endforeach;
                                    ?>
                            </tbody>
                        </table>
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>