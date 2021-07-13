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
                                <?php
                                //cacah data dari tabel detail pembelian dengan id sesuai dengan inputan user
                                foreach ($order as $cacah) :
                                    $tgl2 = date("Y-m-d", strtotime($cacah['tgl_jual'])); // format asli
                                    $tgl = date("d-m-Y", strtotime($cacah['tgl_jual'])); 
                                    $no = 1;
                                    $total = 0;
                                    $no_nota = $cacah['no_nota'];
                                    $tanggal = $cacah['tgl_jual'];
                                    // $id_bom = $cacah['id_bom'];
                                    $no_nota = $cacah['no_nota'];
                                    $nama_minum = $cacah['nama_minum'];
                                    // $id_minum = $cacah['id_minum'];
                                    // $nama_bb = $cacah['nama_bb'];
                                    $nama_pegawai = $cacah['nama_pegawai'];
                                    $nama_topping = $cacah['nm_topping'];
                                    $jumlah = $cacah['jml_produk'];

                                endforeach; ?>

                                <h3 class="card-title">Detail Pesanan Tanggal <?= $tgl; ?></h3>
                                <div class="text-right">
                                </div>
                            </div>

                            <!-- <div align="right"> -->
                            <form action="<?php echo site_url('produksi/create') ?>" method="post">
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <table id="example1" class="table table-bordered table-hover md-6">

                                            <thead class='thead-light text-center'>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>No. Nota</th>
                                                    <th>Waktu Pesanan</th>
                                                    <th>Nama Pegawai</th>
                                                    <th>Nama Produk</th>
                                                    <th>Topping</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($order as $cacah) :
                                                    // echo "<b>No. Nota	 : </b> " . $cacah['no_nota'] . "<br>";
                                                    // echo "<b>Waktu Pesanan	 : </b> " . $tanggal . "<br>";
                                                    // echo "<b>Nama Pegawai	 : </b> " . $nama_pegawai . "<br><br>";

                                                    echo "<tr class='text-center'>";
                                                    echo "<td>" . $no++ . "</td>";
                                                    echo "<td>" . $cacah['no_nota'] . "</td>";
                                                    echo "<td>" . date("d-m-Y H:i:s", strtotime($cacah['tgl_jual'])) . "</td>";
                                                    echo "<td>" . $nama_pegawai . "</td>";
                                                    echo "<td><input type='text' name='id_minum' readonly hidden value='" . $cacah['id_minum'] . "'>" . $cacah['nama_minum'] . "</td>";
                                                    if ($nama_topping != 'none') {
                                                        echo "<td>" . $cacah['nm_topping'] . "</td>";
                                                    } elseif ($nama_topping = 'none') {
                                                        echo "<td>-</td>";
                                                    }
                                                    echo "<td>" . $cacah['jml_produk'] . "</td>";
                                                    $total = $total + $cacah['jml_produk'];
                                                    echo "</tr>";
                                                endforeach;
                                                // echo "<tr>";
                                                // echo "<td colspan='6' class='text-right'>Total</td>";
                                                // echo "<td class='text-center'>" . $total . "</td>";
                                                // echo "</tr>"
                                                ?>
                                            </tbody>
                                        </table>
                                        <div class="form-group">
                                            <input type="text" class="form-control" hidden name="tgl" readonly value="<?php echo $tgl2; ?>" />
                                            <!-- <?php echo "<b>" . form_error('no_pemakaian') . "</b>"; ?>  -->
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div>
                                        <a href="<?= site_url('produksi/view') ?>" data-role="button" data-inline="true" class="btn btn-info btn-sm">
                                            <span class="fas fa-angle-double-left"></span> Kembali
                                        </a>

                                        <button data-role="button" type="submit" data-inline="true" class="btn btn-sm btn-success">
                                            <span class="fa fa-check"></span> Proses </button>
                                    </div>
                                </div>
                            </form>
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