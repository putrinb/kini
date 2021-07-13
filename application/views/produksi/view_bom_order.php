<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
    <div class="wrapper">

        <!-- Main content -->
        <form action="<?php echo site_url('produksi/bop') ?>" method="post">

            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Biaya Produksi</h3>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="no_produksi">No. Pencatatan:</label>
                                            <input type="text" hidden class="form-control" name="no_produksi" readonly value="<?php echo $_SESSION['no_produksi']; ?>"><br><?= $_SESSION['no_produksi']; ?>
                                            <!-- <?php echo "<b>" . form_error('no_pemakaian') . "</b>"; ?> -->
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal:</label>
                                            <div class="input-group date">
                                                <input type="date" hidden name="tgl" readonly class="form-control" value="<?php echo $_SESSION['tgl2']; ?>" />
                                            </div><?= date("d-m-Y", strtotime($_SESSION['tgl2'])); ?>
                                            <?php echo "<b>" . form_error('tanggal') . "</b>"; ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal Perhitungan:</label>
                                            <div class="input-group date">
                                                <input type="text" hidden name="waktu" readonly class="form-control" value="<?= date("Y-m-d H:i:s") ?>" />
                                            </div><?= date("d-m-Y H:i:s"); ?>
                                            <?php echo "<b>" . form_error('tanggal') . "</b>"; ?>
                                        </div>
                                    </div>
                                </div>

                                <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mt-2">Detail Pesanan</h3>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <div>
                                <h6 class="text-bold">Daftar Produk</h6>
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">No. Nota</th>
                                            <th class="text-center">Nama Produk</th>
                                            <th class="text-center">Topping</th>
                                            <th class="text-center">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $total_order = 0;
                                        foreach ($order as $cacah) :
                                            $total_order = $total_order + $cacah['jml_produk'];
                                            echo "<tr>";
                                            echo "<td class='text-center'>" . $no++;
                                            "</td>";
                                            echo "<td>" . $cacah['no_nota'] . "</td>";
                                            echo "<td>" . $cacah['nama_minum'] . "</td>";
                                            echo "<td>" . $cacah['nm_topping'] . "</td>";
                                            echo "<td>" . $cacah['jml_produk'] . "</td>";
                                            // echo "<td>" . format_rp($cacah['harga_bahan']) . "</td>";
                                            echo "</tr>";
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <hr style="height:1px;border:none;color:#333;background-color:#333;" />

                            <div>
                                <h6 class="text-bold">Daftar Bahan Baku</h6>
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Bahan Baku</th>
                                            <th class="text-center">Spesifikasi</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">Satuan</th>
                                            <th class="text-center">Harga</th>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $total = 0;
                                        foreach ($bom as $cacah) :
                                            $hargaBB = $cacah['harga_bb'] / $cacah['jumlah'];
                                            $nilai = $hargaBB * $cacah['qty'];
                                            // $harga_tp = $cacah['harga']/$cacah['penggunaan'];
                                            echo "<tr>";
                                            echo "<td class='text-center'>" . $no++ . "</td>";
                                            echo "<td>" . $cacah['nama_bb'] . "</td>";
                                            echo "<td>" . $cacah['merk'] . "</td>";
                                            echo "<td>" . $cacah['qty'] . "</td>";
                                            echo "<td>" . $cacah['satuan_bb'] . "</td>";
                                            echo "<td class='text-right'>" . format_rp($nilai) . "</td></tr>";
                                            $total = $total + $nilai;
                                        // echo "<td>" . $harga_topping . "</td>";

                                        endforeach;
                                        $total_bb = $total * $total_order;
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <div>
                                <table id="example2" class="table table-condensed">
                                    <tbody>
                                        <?php
                                        echo "<tr>";
                                        echo "<td class=' text-bold'>Total Bahan Baku</td>";
                                        echo "<td class='text-bold'>" . format_rp($total_bb) . "</td>";
                                        echo "</tr>";
                                        ?>
                                        <!-- <td rowspan='2' colspan='4' class='text-right'>Topping</td> -->
                                        <?php
                                        $subtotal = 0;
                                        $bbb = 0;

                                        foreach ($hargaTopping as $row) :
                                            $hargaper_tp = $row['harga_tp'] / 200 * $row['jml_pakai'] * $row['jml_tp'];
                                            echo "<tr>";
                                            echo "<td class=''> Topping " . $row['nm_topping'] . " x " . $row['jml_tp'] . "</td>";
                                            echo "<td class=''>" . format_rp($hargaper_tp) . "</td>";
                                            echo "</tr>";
                                            $subtotal = $subtotal + $hargaper_tp;

                                        endforeach;

                                        $bbb = $bbb + $total_bb + $subtotal;

                                        echo "<tr>";
                                        echo "<td class=' text-bold'>Total Biaya Topping</td>";
                                        echo "<td class=' text-bold'>" . format_rp($subtotal) . "</td>";
                                        echo "</tr>";

                                        echo "<tr>";
                                        echo "<td class=' text-bold'>Biaya Bahan Baku</td>";
                                        echo "<td class=' text-bold'><input name='nilai_bbb' hidden value='" . $bbb . "'/>" . format_rp($bbb) . "</td>";
                                        echo "</tr>";

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="col-sm-12 text-center">
                                <div>
                                    <a href="<?= site_url('produksi/batal') ?>" data-role="button" data-inline="true" class="btn btn-danger btn-sm">
                                        <span class="fas fa-times"></span> Batal
                                    </a>

                                    <button data-role="button" type="submit" data-inline="true" class="btn btn-sm btn-success">
                                        <span class="fa fa-check"></span> Selanjutnya </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
    <!-- </div> -->

    <!-- <script src="<?= base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script> -->

    <script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(function() {
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
</body>