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
                                <!-- <div class="text-right">
                                    <a href="<?= site_url('#') ?>" class="btn btn-success">
                                        <span class="fa fa-print"></span> Cetak</a>
                                </div> -->
                            </div>

                            <!-- <div align="right"> -->
                            <div class="card-body">
                                <div class="container-fluid">
                                    <h5 class="text-center text-uppercase">Penerimaan Bahan Baku</h5>
                                    <table id="example1" class="table table-bordered table-hover md-6">
                                        <div class="d-flex justify-content-between mt-2 mb-4">

                                            <?php
                                            //cacah data dari tabel detail pembelian dengan id sesuai dengan inputan user
                                            foreach ($data_penerimaan as $cacah) :
                                                $id_penerimaan = $cacah['id_penerimaan'];
                                                $tanggal = $cacah['tanggal'];
                                                $kode_bb = $cacah['kode_bb'];
                                                $harga = $cacah['harga'];
                                                $qty = $cacah['qty'];
                                                $berat = $cacah['jumlah'];
                                                $nama_bb = $cacah['nama_bb'];
                                                $satuan_bb = $cacah['satuan_bb'];
                                                $nm_penerima = $cacah['nm_penerima'];
                                                $keterangan = $cacah['keterangan'];
                                                $merk = $cacah['merk'];

                                            endforeach;
                                            $newDate = date("d-m-Y", strtotime($tanggal));
                                            echo "<div><strong>No. : </strong>" . $id_penerimaan . "</div>";
                                            echo "<div><strong>Tanggal:  </strong>" . $newDate ."<br></div>"; //dd-mm-YYYY

                                            ?>
                                            <!-- <table id="example2" class="table table-bordered table-hover md-6"> -->
                                            <thead class="thead-light mt-4">
                                                <tr>
                                                    <th class="text-center">No.</th>
                                                    <th class="text-center">Nama Barang</th>
                                                    <th class="text-center">Spesifikasi</th>
                                                    <th class="text-center">Berat</th>
                                                    <th class="text-center">Satuan</th>
                                                    <th class="text-center">Jumlah</th>
                                                    <th class="text-center">Harga</th>
                                                    <th class="text-center">Total</th>
                                                    <th class="text-center">Keterangan Produk</th>
                                                    <!-- <th class="text-center">Ubah/Hapus</th> -->
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($data_penerimaan as $cacah) :
                                                    echo "<tr>";
                                                    echo "<td class='text-center'>" . $no++."</td>";
                                                    echo "<td>" . $cacah['nama_bb'] . "</td>";
                                                    echo "<td>" . $cacah['merk'] . "</td>";
                                                    echo "<td>" . $cacah['jumlah'] . "</td>";
                                                    echo "<td class='text-center'>" . $cacah['satuan'] . "</td>";
                                                    echo "<td class='text-center'>" . $cacah['qty'] . " item</td>";
                                                    echo "<td>" . format_rp($cacah['harga']) . "</td>";
                                                    echo "<td>" . format_rp($cacah['qty'] * $cacah['harga']) . "</td>";
                                                    echo "<td>" . $cacah['ket'] . "</td>";
                                                    echo "</tr>";
                                                endforeach;
                                                ?>
                                                <tr>
                                                    <td colspan="9">Diterima oleh: <strong><?= $nm_penerima; ?></strong></td>

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
                                <button onclick="location.href = '<?php echo site_url('penerimaan/view_data') ?>'" type="button" class="btn btn-info btn-sm">
                                    <span class="fas fa-angle-double-left"></span> Kembali
                                </button>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#example').DataTable();
                                });
                            </script>

                            <script>
                                $(function() {
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
                                function deleteConfirm(url) {
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