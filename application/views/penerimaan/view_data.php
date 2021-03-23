<div class="wrapper">   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php if( $this->session->flashdata('flash') ) : ?>
      <div class="div row mt-3">
          <div class="div col md-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              Data penerimaan<strong> berhasil </strong><?=$this->session->flashdata('flash');?>!
              <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
            </div>
          </div>
      </div>
      <?php endif; ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title mt-2">Data Penerimaan Bahan Baku</h3>
                  <div class="text-right">
                    <a href="<?=site_url('penerimaan/add')?>" class="btn btn-info btn-sm">
                      <span class="fa fa-plus"></span> Tambah</a>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                        <table id="example" class="table table-bordered table-hover mt-3">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No. Penerimaan</th>
                                    <th>Tanggal Penerimaan</th>
                                    <th>Penerima</th>
                                    <th>No. Faktur</th>
                                    <!--<th class="text-center">Upload</th>-->
                                    <!-- <th>Detail</th> -->
                                    <th colspan="2">Aksi</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                    $no=1;
                                    foreach($data_penerimaan as $cacah):
                                    echo "<tr>";
                                    echo "<td class='text-center'>".$no++;"</td>";
                                    echo "<td>".$cacah['id_penerimaan']."</td>";
                                    echo "<td>".$cacah['tanggal']."</td>";
                                    echo "<td>".$cacah['nm_penerima']."</td>";
                                    echo "<td>".$cacah['no_faktur']."</td>";
                                    
                                ?>
                                    <td class="text-center">
                                        <button onclick="location.href = '<?php echo site_url('penerimaan/view_data_detail/'.$cacah['id_penerimaan'].'/'.$cacah['id_pembelian']) ?>'" type="button" class="btn btn-info btn-sm">
                                        <span class="fas fa-info-circle"></span> Detail</button>
                                        <!-- <button onclick="location.href = '<?php echo site_url('penerimaan/edit_form/'.$cacah['id_penerimaan'].'/'.$cacah['id_pembelian']) ?>'" type="button" class="btn btn-success btn-sm">
                                            <span class="fas fa-edit"></span> Ubah
                                        </button> -->
                                    <a onclick="deleteConfirm('<?php echo site_url('penerimaan/delete_data/'.$cacah['id_penerimaan'].'/'.$cacah['id_pembelian']) ?>')" href="#!" class="btn btn-danger btn-sm">
                                        <span class="fas fa-trash"></span>
                                    </a>
                                    </td>
                            <?php
                            endforeach;
                            ?>
                            </tbody>
                        </table>
                        <!-- DataTables -->
                        <script>
                        $(document).ready(function() {
                            $('#example').DataTable();
                        } );
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
                        </table>
                      </div>
                    </div>
                   </div>
                </div>
              </div>
            </div>
        </div>
    </section>
</div>