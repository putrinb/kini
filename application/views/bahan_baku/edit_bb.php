<body>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- general form elements -->
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Edit Bahan Baku</h3>
                </div>

                <!-- form start -->
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <input type="hidden" name="kode_bb" class="form-control" value="<?= $bahanbaku['kode_bb'] ?>">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label><b>Nama Bahan Baku</label><span class="text-danger">*</span>
                                    <input type="text" name="nama_bb" maxlength="50" class="form-control" value="<?= $bahanbaku['nama_bb']; ?>" placeholder="Masukan nama bahan baku">
                                    <?php echo "<b>" . form_error('nama_bb') . "</b>"; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Merk</label><span class="text-danger">*</span>
                                    <input type="text" name="merk" id="merk" class="form-control merk" maxlength="30" value="<?= $bahanbaku['merk']; ?>" placeholder="ABC">
                                    <?php echo "<b>" . form_error('merk') . "</b>"; ?>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Berat</label><span class="text-danger">*</span>
                                    <input name="jml" type="number" class="form-control" value="<?= $bahanbaku['jumlah']; ?>" placeholder="Masukkan Jumlah" min="0">
                                    <?php echo "<b>" . form_error('jml') . "</b>"; ?>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Satuan</label><span class="text-danger">*</span>
                                    <select name="satuan" class="form-control" id="satuan" placeholder="Pilih Satuan">
                                        <option value="">- Pilih Satuan -</option>
                                        <?php foreach ($satuan as $s) : ?>
                                            <?php if ($s == $bahanbaku['satuan']) : ?>
                                                <option value="<?= $s; ?>" selected><?= $s; ?></option>
                                            <?php else : ?>
                                                <option value="<?= $s; ?>"><?= $s; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php echo "<b>" . form_error('satuan') . "</b>"; ?>
                                </div>
                            </div>
                        <!-- </div> -->

                        <!-- <div class="row"> -->
                            <div class="form-group col-sm-3">
                                <label class="col-form-email">Stok</label>
                                <input type="number" readonly name="stok_awal" min="0" class="form-control" value="<?= $bahanbaku['stok_awal']; ?>" placeholder="Masukan stok awal">
                                <?php echo "<b>" . form_error('stok_awal') . "</b>"; ?>
                            </div>

                            <!-- <div class="form-group col-sm-6">
                                <label class="col-form-email">Batas Stok Minimal</label>
                                <input type="number" name="stok_min" min="0" class="form-control" value="<?= $bahanbaku['batas_min']; ?>" placeholder="Masukan Batas Stok Minimal">
                                <?php echo "<b>" . form_error('stok_min') . "</b>"; ?>
                            </div>-->
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="text-right">
                            <a href="<?= site_url('bahan_baku/view_data') ?>" class="btn btn-danger"><span class="fa fa-times"></span> Batal
                            </a>
                            <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.card -->
    <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.mask.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.harga_satuan').mask('000.000.000.000.000', {
                reverse: true
            });
        });
    </script>
</body>

</html>