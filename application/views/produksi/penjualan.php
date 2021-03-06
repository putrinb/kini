<div class="wrapper">   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php if( $this->session->flashdata('flash') ) : ?>
      <div class="div row mt-3">
          <div class="div col md-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              Proses <strong><?=$this->session->flashdata('flash');?></strong>.
              <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
            </div>
          </div>
      </div>
      <?php endif; ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title mt-2">Data Pesanan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead class="text-center">
                        <tr>
                            <th>No.</th>
                            <!-- <th>No. Nota</th> -->
                            <th>Tanggal</th>
                            <th>Pegawai</th>
                            <th>Total</th>
                            <!--<th class="text-center">Upload</th>-->
                            <th>Aksi</th>
                        </tr>
                    </thead>
                            <tbody>
                            
                                <?php
                                    $no=1;
                                    
                                    foreach($sales as $row):
                                    $tgl = date("d-m-Y", strtotime($row['waktu']));
                                    $tgl2 = date("Y-m-d", strtotime($row['waktu']));
                                    echo "<tr class='text-center'>";
                                    echo "<td>".$no++;"</td>";
                                    // echo "<td>".$row['no_nota']."</td>";
                                    echo "<td>".$tgl."</td>";
                                    echo "<td>".$row['nama_pegawai']."</td>";
                                    echo "<td class='text-left'>".$row['total_jual']."</td>";
                                    // echo "<td>".$row['nm_penerima']."</td>";
                                    // echo "<td>".$row['no_faktur']."</td>";
                                ?>
                                
                                    <td class="text-center">
                                        <button onclick="location.href = '<?php echo site_url('produksi/detail_order/'.$tgl2.'') ?>'" type="button" class="btn btn-info btn-sm">
                                        <span class="fas fa-eye"></span>
                                        </button>
                                        <?php
                                    echo "</td>";
                                    echo "</tr>";
                                    endforeach;
                                    ?>
                            </tbody>
                        </table>
                        <!-- DataTables -->
        
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
                    </div>
                  </div>    
            </div>
        </div>
        </div>
    </section>
</div>