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
        <section class="content">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Laporan Harga Pokok Penjualan</h3>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <b>Kini Cheese Tea</b>
                            </div>
                            <div class="col-sm-12 text-center">
                                <b>Laporan Harga Pokok Penjualan</b>
                            </div>
                            <div class="col-sm-12 text-center">
                                <b>Periode <?php echo format_bulan($bulan) . " " . $tahun; ?></b>
                            </div>
                        </div>
                        <table class="table table-condensed">
                        <!-- <table id="example1" class="table table-bordered table-hover"> -->
                            <thead>
                                <tr>
                                    <th colspan=3><b>Persediaan Awal</b></th>
                                    <td class='text-right'>-<b></b></td>

                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td colspan=3><b>Persediaan dalam Proses</b></td>
                                    <td class='text-right'>-<b></b></td>
                                </tr>
                                <tr>
                                    <td colspan=3><b>Biaya Produksi</b></td>
                                </tr>
                                <tr>
                                    <td colspan=3>&emsp;&emsp;Biaya Bahan Baku</td>
                                    <td class='text-left'>
                                        <b>
                                            <?php
                                            $total_bbb = 0;
                                            foreach ($hpp as $row) :
                                                $total_bbb = $total_bbb + $row['total_bbb'];
                                            endforeach;
                                            echo format_rp($total_bbb);

                                            ?>
                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=3>&emsp;&emsp;Biaya Tenaga Kerja Langsung</td>
                                    <td class='text-left'>
                                        <b>
                                            <?php
                                            $total_btkl = 0;
                                            foreach ($hpp as $row) :
                                                $total_btkl = $total_btkl + $row['total_btkl'];
                                            endforeach;
                                            echo format_rp($total_btkl);

                                            ?>
                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=3>&emsp;&emsp;Biaya Overhead Pabrik</td>
                                    <td class='text-left'>
                                        <b>
                                            <?php
                                            $total_bop = 0;
                                            foreach ($hpp as $row) :
                                                $total_bop = $total_bop + $row['total_bop'];
                                            endforeach;
                                            echo format_rp($total_bop);

                                            ?>
                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=3>&emsp;&emsp;&emsp;&emsp;<b>Total Biaya Produksi</b></td>
                                    <td class='text-right'>
                                        <b>
                                            <?php
                                            $biaya = 0;
                                            foreach ($hpp as $row) :
                                                $biaya = $total_bbb + $total_btkl + $total_bop;
                                            endforeach;
                                            echo format_rp($biaya);

                                            ?>
                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan=3><b>Persediaan Akhir</b></th>
                                    <td class='text-right'>-<b></b></td>
                                </tr>
                                <tr>
                                    <td colspan=3 style="background-color: #eee"><b>Harga Pokok Penjualan</b></td>
                                    <td class='text-right' style="background-color: #eee">
                                        <b><?= format_rp($biaya) ?></b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button onclick="location.href = '<?php echo site_url('laporan/hpp') ?>'" type="button" class="btn btn-info btn-sm">
                            <span class="fas fa-angle-double-left"></span> Kembali
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>