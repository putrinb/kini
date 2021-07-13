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
                                <h3 class="card-title">Kartu Stok</h3>
                            </div>

                            <!-- <div align="right"> -->
                            <div class="card-body">
                                <div class="container-fluid">
                                    <h3 class="text-center text-uppercase">Kartu Stok</h3>
                                    <table id="example1" class="table table-bordered table-hover md-6">
                                        <div class="d-flex justify-content-between mt-4">

                                            <?php
                                            //cacah data dari tabel detail pembelian dengan id sesuai dengan inputan user
                                            foreach ($bahan_baku as $row) {
                                                $nama_bb = $row['nama_bb'];
                                                $kode_bb = $row['kode_bb'];
                                                $merk = $row['merk'];
                                            }
                                            // echo "<div><strong>No. : </strong> </div>";
                                            echo "<div><strong>Nama Barang: " . $nama_bb . "  </strong> </div></div>";
                                            echo "<div><strong>Spesifikasi:  " . $merk . "</strong> <br></div>";
                                            echo "<div><strong>Periode: " . format_bulan($bulan) . " " . $tahun . "</strong></div>";

                                            // echo "<div><strong>Nama Pemasok:  </strong>".$nama_supplier."<br></div>";

                                            ?>
                                            <!-- <table id="example2" class="table table-bordered table-hover md-6"> -->
                                            <thead class="thead-light">
                                                <tr>
                                                    <th rowspan="2" class="text-center align-middle">Tanggal</th>
                                                    <th colspan="3" class="text-center">Diterima</th>
                                                    <th colspan="3" class="text-center">Dipakai</th>
                                                    <th colspan="3" class="text-center">Saldo</th>

                                                </tr>
                                                <tr>
                                                    <!-- <td class="text-center">No. Transaksi</td> -->
                                                    <th class="text-center">Kuantitas</th>
                                                    <th class="text-center">Harga Satuan</th>
                                                    <th class="text-center">Total</th>

                                                    <th class="text-center">Kuantitas</th>
                                                    <th class="text-center">Harga Satuan</th>
                                                    <th class="text-center">Total</th>

                                                    <th class="text-center">Kuantitas</th>
                                                    <th class="text-center">Harga Satuan</th>
                                                    <th class="text-center">Total</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr class='text-center'>
                                                    <td>01-<?= $bulan . "-" . $tahun ?></td>

                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td><?php $stok2 = $stok;
                                                        echo $stok2 ?></td>
                                                    <td>-</td>
                                                    <td class='text-left'><?php $harga_awal = $harga;
                                                                            echo format_rp($harga * $stok2) ?></td>
                                                </tr>
                                                <?php
                                                $no = 1;
                                                foreach ($dataKartuStok as $row) :
                                                    $stok = $row['total_pembelian'];
                                                    // $row['total_penjualan'];
                                                    echo "<tr  class='text-center'>";
                                                    echo "<td>" . $row['waktu'] . "</td>";
                                                    echo "<td>" . $row['total_pembelian'] . "</td>";
                                                    echo "<td class='text-left'>" . format_rp($row['harga']) . "</td>";
                                                    echo "<td class='text-left'>" . format_rp($row['harga'] * $row['total_pembelian']) . "</td>";
                                                    echo "<td></td>";
                                                    echo "<td></td>";
                                                    echo "<td></td>";

                                                    echo "<td>" . $stok2 . "</td>";
                                                    echo "<td class='text-left'>" . format_rp($harga_awal) . "</td>";
                                                    echo "<td class='text-left'>" . format_rp($stok2 * $harga_awal) . "</td></tr>";
                                                    echo "</tr>";
                                                    if ($stok2 != 0) {
                                                        for ($i = 0; $i < 1; $i++) :

                                                            echo "<tr class='text-center'>";
                                                            echo "<td></td>";
                                                            echo "<td></td>";
                                                            echo "<td></td>";
                                                            echo "<td></td>";
                                                            echo "<td></td>";
                                                            echo "<td></td>";
                                                            echo "<td></td>";
                                                            echo "<td>" . $stok . "</td>";
                                                            echo "<td class='text-left'>" . format_rp($row['harga']) . "</td>";
                                                            echo "<td class='text-left'>" . format_rp($stok * $row['harga']) . "</td></tr>";
                                                        endfor;
                                                    }else{
                                                    echo "<tr>";
                                                    echo "<td></td>";
                                                    echo "<td></td>";
                                                    echo "<td></td>";
                                                    echo "<td></td>";
                                                    echo "<td></td>";
                                                    echo "<td></td>";
                                                    echo "<td></td>";
                                                    echo "<td></td>";"<td>" . $stok . "</td>";
                                                    echo "<td class='text-left'>" . format_rp($row['harga']) . "</td>";
                                                    echo "<td class='text-left'>" . format_rp($stok * $row['harga']) . "</td>";

                                                    echo "</tr>";}
                                                endforeach;
                                                ?>
                                                <tr>
                                                    <!-- <td colspan="8">Diterima oleh: <strong><?= $nm_penerima; ?></strong></td> -->

                                                </tr>
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button onclick="location.href = '<?php echo site_url('laporan/KartuStok') ?>'" type="button" class="btn btn-info btn-sm">
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