<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini">
<div class="wrapper">   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Penerimaan</h3>
                    <div class="text-right">
                        <a href="<?=site_url('#')?>" class="btn btn-success">
                      <span class="fa fa-print"></span> Cetak</a>
                  </div>
                </div>
            
                  <!-- <div align="right"> -->
                    <div class="card-body">
                        <div class="container"> 
                            <h3 class="text-center text-uppercase">laporan penerimaan barang</h3>
                            <table id="example1" class="table table-bordered table-hover md-6">
                            <div class="d-flex justify-content-between mt-4">
                            
                                <?php 
                                    //cacah data dari tabel detail pembelian dengan id sesuai dengan inputan user
                                    foreach($data_penerimaan as $cacah):
                                        $id_penerimaan = $cacah['id_penerimaan'];
                                        $tanggal = $cacah['tanggal'];
                                        $kode_bb = $cacah['kode_bb'];
                                        $harga_satuan = $cacah['harga_satuan'];
                                        $qty = $cacah['qty'];
                                        $nama_bb = $cacah['nama_bb'];
                                        $no_faktur = $cacah['no_faktur'];
                                        $nama_supplier = $cacah['nama_supplier'];
                                        $satuan_bb = $cacah['satuan_bb'];
                                        $nm_penerima= $cacah['nm_penerima'];
                                        $keterangan = $cacah['keterangan'];
                                        $merk = $cacah['merk'];
                                    endforeach;
                                    
                                        echo "<div><strong>No. : </strong>".$id_penerimaan."</div>";
                                        echo "<div><strong>No. Faktur	 :  </strong>".$no_faktur."</div></div>";
                                        echo "<div><strong>Tanggal:  </strong>".$tanggal."<br></div>";
                                        echo "<div><strong>Nama Pemasok:  </strong>".$nama_supplier."<br></div>";
                                        
                                        ?>
                            <!-- <table id="example2" class="table table-bordered table-hover md-6"> -->
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Spesifikasi</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Satuan</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Keterangan Produk</th>
                                        <!-- <th class="text-center">Ubah/Hapus</th> -->
                                    </tr>
                                </thead>

                                <tbody>
                                <?php
                                $no=1;
                                    foreach($data_penerimaan as $cacah):
                                        echo "<tr>";
                                            echo "<td class='text-center'>".$no++;"</td>";
                                            echo "<td>".$cacah['kode_bb']." - ".$cacah['nama_bb']."</td>";
                                            echo "<td>".$cacah['merk']."</td>";
                                            echo "<td class='text-center'>".$cacah['qty']."</td>";
                                            echo "<td class='text-center'>".$cacah['satuan_bb']."</td>";
                                            echo "<td>".format_rp($cacah['harga_satuan'])."</td>";
                                            echo "<td>".format_rp($cacah['qty']*$cacah['harga_satuan'])."</td>";
                                            echo "<td>".$cacah['ket']."</td>";
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
                                <tr>
                                    <td colspan="8">Diterima oleh: <strong><?=$nm_penerima;?></strong></td>

                                </tr>
                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Bahan Baku</th>
                                        <th class="text-center">Supplier</th>
                                        <th class="text-center">qty</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Total</th>
                                        <!--<th class="text-center">Ubah/Hapus</th>
                                    </tr>
                                </tfoot> -->
                            </table>
                            </div>
                    </div>
                    <div class="card-footer">
                            <button onclick="location.href = '<?php echo site_url('penerimaan/view_data')?>'" type="button" class="btn btn-info btn-sm">
                                <span class="fas fa-angle-double-left"></span> Kembali
                            </button>
                        </div>
                        <script>
                        $(document).ready(function() {
                            $('#example').DataTable();
                        } );
                        </script>

                        <script>
                            $(function () {
                                $('#example1').DataTable({
                                "paging": true,
                                "lengthChange": true,
                                "searching": true,
                                "ordering": true,
                                "info": true,
                                "autoWidth": true,
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
    </section>
</div>
</body>
</html>