<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini">
<div class="wrapper">   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-light">
                    <div class="card-header">
                        <h3 class="card-title">Edit Detail <i>Bill of Material</i></h3>
                        <div class="text-right">
                            <!-- <button onclick="location.href = '<?php echo site_url('bom/view_data')?>'" type="button" class="btn btn-success btn-sm">
                                <span class="fas fa-print"></span> Cetak
                            </button> -->
                        </div>
                    </div>
              
                  <!-- <div align="right"> -->
                    <div class="card-body">
                        <div class="container">
                            <table id="example1" class="table table-bordered table-hover md-6">
                                <?php 
                                    //cacah data dari tabel detail pembelian dengan id sesuai dengan inputan user
                                    foreach($data_bom as $cacah):
                                        $id_bom = $cacah['id_bom'];
                                        $nama_produk = $cacah['nama_produk'];
                                        $merk = $cacah['merk'];
                                        $satuan = $cacah['satuan'];
                                        $qty = $cacah['qty'];
                                        $id_produk = $cacah['id_produk'];
                                        $nama_bb = $cacah['nama_bb'];
                                    endforeach;
                                    
                                        echo "<b>No. BOM	 : </b> ".$id_bom."<br>";
                                        echo "<b>Kode Produk	 : </b> ".$id_produk."<br>";
                                        echo "<b>Nama Produk	 : </b> ".$nama_produk."<br><br>";
                                        ?>
                                <!-- <div class="container"> -->
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Bahan Baku</th>
                                        <th class="text-center">Merk</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Satuan</th>
                                        <!-- <th class="text-center">Ubah/Hapus</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $no=1;
                                    foreach($data_bom as $cacah):
                                        echo "<tr class='text-center'>";
                                            echo "<td>".$no++;"</td>";
                                            echo "<td>".$cacah['nama_bb']."</td>";
                                            echo "<td>".$cacah['merk']."</td>";
                                            echo "<td><input name='qty' type='number' min='1' class='form-control'></td>";
                                            echo "<td>".$cacah['satuan_bb']."</td>";
                                                ?>
                                                    <!-- <button onclick="location.href = '<?php echo site_url('pembelian/edit_form_detail/'.$cacah['no_penerimaan']) ?>';" type="button" class="btn btn-success btn-sm">
                                                        <span class="glyphicon glyphicon-edit"></span> Ubah
                                                    </button>
                                                    <a onclick="deleteConfirm('<?php echo site_url('pembelian/delete_form_detail2/'.$cacah['no_penerimaan'].'/'.$cacah['id_penerimaan'].'/'.$cacah['id_supplier']) ?>')" href="#!" class="btn btn-danger btn-sm">
                                                        <span class="glyphicon glyphicon-trash"></span> Hapus
                                                    </a> -->
                                                <?php
                                            // echo "</td>";
                                        echo "</tr>";
                                    endforeach;
                                ?>
                                </tbody>
                                </table>
                            </div>
                    </div>
                        <div class="card-footer">
                            <button onclick="location.href = '<?php echo site_url('bom/view_data')?>'" type="button" class="btn btn-info btn-sm">
                                <span class="fas fa-angle-double-left"></span> Kembali
                            </button>
                        </div>
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
                            $('#example').DataTable( {
                                "pagingType": "full_numbers"
                            } );
                        } );
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
    </section>
</div>
</body>
</html>