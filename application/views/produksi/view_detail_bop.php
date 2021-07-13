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
                <?php if ($this->session->flashdata('flash')) : ?>
                    <div class="div row mt-3">
                        <div class="div col md-3">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Data<strong> berhasil </strong><?= $this->session->flashdata('flash'); ?>!
                                <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <form action="<?php echo site_url('produksi/selesai') ?>" method="post">
                    <input type="text" hidden name="no_produksi" value="<?= $_SESSION['no_produksi']; ?>" />
                    <input type="text" hidden name="tgl" value="<?= $_SESSION['tgl2']; ?>" />
                    <input type="text" hidden name="waktu" value="<?= $_SESSION['waktu']; ?>" />
                    <input type="text" hidden name="nilai_bbb" value="<?= $_SESSION['nilai_bbb']; ?>" />


                    <div class="row">
                        <div class="col-12">
                            <div class="card card-light">
                                <div class="card-header">
                                    <h3 class="card-title mt-2">Detail Data</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Nama Penggunaan</th>
                                                <th class="text-center">Besar Daya</th>
                                                <th class="text-center">Lama Penggunaan</th>
                                                <th class="text-center">Biaya</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $total_bop = 0;
                                            foreach ($data_bop as $cacah) :
                                                $watt = $cacah['daya_watt'];
                                                $wkt = $cacah['waktu_menit'];
                                                $tarif = $cacah['tarif_dasar'];
                                                $subtotal = ($watt * $wkt) / 1000 * $tarif;
                                                $total_bop = $total_bop + $subtotal;
                                                echo "<tr>";
                                                echo "<td class='text-center'>" . $no++;
                                                "</td>";
                                                echo "<td>" . $cacah['penggunaan'] . "</td>";
                                                echo "<td>" . $cacah['daya_watt'] . " watt</td>";
                                                echo "<td>" . number_format($cacah['waktu_menit'], 0, ",", ".") . " jam</td>";
                                                echo "<td>" . format_rp($subtotal) . "</td>";

                                                echo "<td align='center'>";
                                            ?><a onclick="deleteConfirm('<?php echo site_url('produksi/delete_bop/' . $cacah['id_bop']) ?>')" href="#!" class="btn btn-danger btn-sm">
                                                    <span class="fas fa-trash"></span>
                                                </a>
                                            <?php
                                                echo "</td>";
                                                echo "</tr>";
                                            endforeach;

                                            ?>
                                            <td colspan="4" class="text-right">Total</td>
                                            <td colspan="5"><input type="text" hidden name="nilai_bop" value="<?= format_rp($total_bop) ?>"><?= format_rp($total_bop) ?></td>

                                        </tbody>

                                    </table>
                                </div>
                                <div class="card-footer">
                                    <div class="col-sm-12 text-center">
                                        <button data-role="button" type="submit" data-inline="true" class="btn btn-sm btn-success">
                                            <span class="fa fa-check"></span> Simpan </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <script src="<?= base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

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
                            <span span aria-hidden="true">X</span>
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
</body>

</html>