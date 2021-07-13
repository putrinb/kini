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
                                <h3 class="card-title">Detail Harga Pokok Produksi</h3>
                                <div class="text-right">
                                    <!-- <button onclick="location.href = '<?php echo site_url('bom/view_data') ?>'" type="button" class="btn btn-success btn-sm">
                                <span class="fas fa-print"></span> Cetak
                            </button> -->
                                    <!-- <button onclick="location.href = '<?php echo site_url('bom/edit_data/' . $cacah['id_bom'] . '/' . $cacah['id_bom']) ?>" type="button" class="btn btn-info btn-sm">
                                <span class="fas fa-edit"></span> Edit
                            </button> -->
                                </div>
                            </div>

                            <!-- <div align="right"> -->
                            <div class="card-body">
                                <div class="container-fluid">
                                    <table id="example1" class="table table-bordered table-hover md-6">
                                        <?php
                                        //cacah data dari tabel detail pembelian dengan id sesuai dengan inputan user
                                        foreach ($data_bom as $cacah) :
                                            $id_bom = $cacah['id_bom'];
                                            $nama_minum = $cacah['nama_minum'];
                                            $merk = $cacah['merk'];
                                            $satuan = $cacah['satuan'];
                                            $qty = $cacah['qty'];
                                            $id_minum = $cacah['id_minum'];
                                            $nama_bb = $cacah['nama_bb'];
                                        endforeach;

                                        echo "<b>No. BOM	 : </b> " . $id_bom . "<br>";
                                        echo "<b>Kode Produk	 : </b> " . $id_minum . "<br>";
                                        echo "<b>Nama Produk	 : </b> " . $nama_minum . "<br><br>";
                                        ?>
                                        <!-- <div class="container"> -->
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Bahan Baku</th>
                                                <th class="text-center">Merk</th>
                                                <th class="text-center">Jumlah</th>
                                                <th class="text-center">Satuan</th>
                                                <th class="text-center">Harga</th>

                                                <!-- <th class="text-center">Ubah/Hapus</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($data_bom as $cacah) :
                                                $hargaBB = $cacah['harga_bb'] / $cacah['jumlah'];
                                                $nilai = $hargaBB * $cacah['qty'];
                                                echo "<tr>";
                                                echo "<td class='text-center'>" . $no++;
                                                "</td>";
                                                echo "<td>" . $cacah['nama_bb'] . "</td>";
                                                echo "<td>" . $cacah['merk'] . "</td>";
                                                echo "<td class='text-center'>" . $cacah['qty'] . "</td>";
                                                echo "<td class='text-center'>" . $cacah['satuan_bb'] . "</td>";
                                                echo "<td>" . format_rp($nilai) . "</td>";

                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button onclick="location.href = '<?php echo site_url('produksi/daftar_hpp') ?>'" type="button" class="btn btn-info btn-sm">
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