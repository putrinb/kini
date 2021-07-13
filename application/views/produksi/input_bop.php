<body>
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <!-- general form elements -->
            <form action="<?php echo site_url('produksi/bop') ?>" method="post">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Biaya Produksi</h3>
                    </div>
                    <div class="card-body">
                        <div class="container">
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
                                        <label for="tanggal">Tanggal Transaksi:</label>
                                        <div class="input-group date">
                                            <input type="date" hidden name="tgl" readonly class="form-control" value="<?php echo $_SESSION['tgl2']; ?>" />
                                        </div><?= date("d-m-Y", strtotime($_SESSION['tgl2'])); ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal Perhitungan:</label>
                                        <div class="input-group date">
                                            <input type="text" hidden name="waktu" readonly class="form-control" value="<?= $_SESSION['waktu'] ?>" />
                                        </div><?= date("d-m-Y H:i:s", strtotime($_SESSION['waktu'])); ?>
                                    </div>
                                </div>
                                <input type="text" hidden name="nilai_bbb" readonly class="form-control" value="<?= $_SESSION['nilai_bbb'] ?>" />
                            </div>
                            <hr style="height:1px;border:none;color:#333;background-color:#333;" />

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-inline form-group mb-1">
                                        <label for="tarif">Tarif dasar listrik<span class="text-danger">*</span></label>
                                        <div class="input-group mb-1 ml-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                            </div>
                                            <input type="text" class="col-sm-12 form-control tarif" name="tarif" value="<?= set_value('tarif'); ?>" placeholder="00.000" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div><?php echo "<b>" . form_error('tarif') . "</b>"; ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-inline form-group mb-1 mt-3">
                                        <label for="type">Jenis Penggunaan<span class="text-danger">*</span></label>
                                        <select class="form-control col-sm-6 form-inline text-center ml-3" name="type">
                                            <option value="">- None -</option>
                                            <?php foreach ($Op as $row) : ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['penggunaan'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div><?php echo "<b>" . form_error('type') . "</b>"; ?>
                                </div>

                                <div class="col-sm-6">
                                    <div class="input-group form-inline mb-6 ml-3 mt-3">
                                        <label for="lama">Lama Penggunaan<span class="text-danger">*</span></label>
                                        <div class="input-group mb-6 ml-3">
                                            <input type="text" class="form-control time" name="lama" value="<?= set_value('lama'); ?>" min="0" placeholder="">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon1">jam</span>
                                            </div>
                                        </div><?php echo "<b>" . form_error('lama') . "</b>"; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
                    <div class="card-footer">
                        <div class="text-center">
                            <button type="submit" class="btn btn-sm btn-success"><span class="fas fa-plus"></span> Tambah</button>
                        </div>
                    </div>
            </form>
        </div>

        <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery.mask.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.tarif').mask('000.000', {
                    reverse: true
                });
                $('.time').mask('0.000', {
                    reverse: true
                });
            });
        </script>
    </section>