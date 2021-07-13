<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/jquery-ui/jquery-ui.min.css'); ?>" /> <!-- Load file css jquery-ui -->
    <script src="<?php echo base_url('assets/jquery.min.js'); ?>"></script> <!-- Load file jquery -->
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <!-- <div align="right"> -->
                            <div class="card-body">

                                <form method="get" action="">
                                    <div class="form-group">
                                        <label>Filter Berdasarkan</label><br>
                                        <select class="col-sm-2 form-control" name="filter" id="filter">
                                            <option value="">Pilih</option>
                                            <option value="1">Tanggal</option>
                                            <option value="2">Bulan</option>
                                            <option value="3">Tahun</option>
                                        </select>
                                    </div>
                                    <div id="form-tanggal" class="form-group col-sm-2">
                                        <label>Tanggal</label><br>
                                        <!-- <div class="col-sm-2"> -->
                                            <input type="text" name="tanggal" class="input-tanggal" />
                                        <!-- </div> -->
                                    </div>
                                    <div id="form-bulan" class="form-group">
                                        <div class="col-sm-2">
                                            <label>Bulan</label><br>
                                            <select name="bulan" class="form-control">
                                                <option value="">Pilih</option>
                                                <option value="1">Januari</option>
                                                <option value="2">Februari</option>
                                                <option value="3">Maret</option>
                                                <option value="4">April</option>
                                                <option value="5">Mei</option>
                                                <option value="6">Juni</option>
                                                <option value="7">Juli</option>
                                                <option value="8">Agustus</option>
                                                <option value="9">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="form-tahun" class="form-group">
                                        <div class="col-sm-2">
                                            <label>Tahun</label><br>
                                            <select name="tahun" class="form-control">
                                                <option value="">Pilih</option>
                                                <?php
                                                foreach ($option_tahun as $data) { // Ambil data tahun dari model yang dikirim dari controller
                                                    echo '<option value="' . $data->tahun . '">' . $data->tahun . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn btn-success" type="submit">Tampilkan</button>
                                    <button class="btn btn-secondary" type="submit">
                                        <a href="<?php echo site_url('laporan'); ?>" style="color: white">Reset Filter</a>
                                    </button>
                                </form>
                                <hr />

                                <div class="text-center text-bold text-uppercase mb-3">
                                    <h5><?php echo $ket; ?></h5>
                                    <hr>
                                </div>
                                <!-- <a href="<?php echo $url_cetak; ?>">CETAK PDF</a><br /><br /> -->
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <th>Tanggal Transaksi</th>
                                        <th>No. Faktur</th>
                                        <!-- <th>Pemasok</th> -->
                                        <th>Deskripsi Barang</th>
                                        <th>Jumlah</th>
                                        <!-- <th>Subtotal</th> -->
                                    </thead>
                                    <?php
                                    if (!empty($transaksi)) {
                                        $no = 1;
                                        $gtotal = 0;
                                        foreach ($transaksi as $data) {
                                            $tgl = date('d-m-Y', strtotime($data->tanggal));

                                            echo "<tr>";
                                            echo "<td>" . $tgl . "</td>";
                                            echo "<td>" . $data->id_penerimaan . "</td>";
                                            // echo "<td>".$data->nama_supplier."</td>";
                                            echo "<td>" . $data->nama_bb . "</td>";
                                            echo "<td>" . $data->qty . "</td>";
                                            // echo "<td>".format_rp($data->qty*$data->harga_satuan)."</td>";
                                            // $gtotal=$gtotal+($data->qty*$data->harga_satuan);

                                            echo "</tr>";
                                            $no++;
                                        }
                                        // echo "<tr>";
                                        // echo "<td colspan='4' class='text-right text-bold'>TOTAL</td>";
                                        // echo "<td class='text-bold'>". format_rp($gtotal);"</td>";
                                        // echo "</tr>";
                                    }
                                    "<tr>
                <td colspan='5' class='text-right text-bold'>TOTAL</td>
                <td class='text-bold'>" . "</td>
            </tr>";
                                    ?>
                                    <!-- <tr>
                <td colspan="5" class="text-right text-bold">TOTAL</td>
                <td class="text-bold"></td>
            </tr> -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    <script src="<?php echo base_url('assets/jquery-ui/jquery-ui.min.js'); ?>"></script> <!-- Load file plugin js jquery-ui -->
    <script>
        $(document).ready(function() { // Ketika halaman selesai di load
            $('.input-tanggal').datepicker({
                dateFormat: 'yy-mm-dd' // Set format tanggalnya jadi yyyy-mm-dd
            });
            $('#form-tanggal, #form-bulan, #form-tahun').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya
            $('#filter').change(function() { // Ketika user memilih filter
                if ($(this).val() == '1') { // Jika filter nya 1 (per tanggal)
                    $('#form-bulan, #form-tahun').hide(); // Sembunyikan form bulan dan tahun
                    $('#form-tanggal').show(); // Tampilkan form tanggal
                } else if ($(this).val() == '2') { // Jika filter nya 2 (per bulan)
                    $('#form-tanggal').hide(); // Sembunyikan form tanggal
                    $('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
                } else { // Jika filternya 3 (per tahun)
                    $('#form-tanggal, #form-bulan').hide(); // Sembunyikan form tanggal dan bulan
                    $('#form-tahun').show(); // Tampilkan form tahun
                }
                $('#form-tanggal input, #form-bulan select, #form-tahun select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
            })
        })
    </script>