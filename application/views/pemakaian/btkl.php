<div class="container">
                <!-- general form elements -->
                <div class="card">
                    <!-- <div class="card-header">
                        <h3 class="card-title">Biaya Produksi</h3>
                    </div> -->
                    <div class="card-body">
                        <div class="container">
                            <form action="<?php echo site_url('pemakaian/input_form_detail') ?>" method="post">

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="gaji">Gaji Perhari<span class="text-danger">*</span>
                                            </label>
                                            <input type="text" id="harga_satuan" name="gaji" min="0" value="<?= set_value('gaji'); ?>" class="form-control harga_satuan" placeholder="000.000.000.000.000">
                                            <?php echo "<b>" . form_error('gaji') . "</b>"; ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="day">Jumlah Hari<span class="text-danger">*</span></label>
                                            <input class="form-control" name="day" value="<?= set_value('day'); ?>" type="number" min="1" placeholder="1"></input>
                                            <?php echo "<b>" . form_error('day') . "</b>"; ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="person">Jumlah Karyawan<span class="text-danger">*</span></label>
                                            <input class="form-control" name="person" value="<?= set_value('person'); ?>" type="number" min="1" placeholder="1"></input>
                                            <?php echo "<b>" . form_error('person') . "</b>"; ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="sales">Rata-rata Penjualan Perhari<span class="text-danger">*</span></label>
                                            <input class="form-control" name="sales" value="<?= set_value('sales'); ?>" type="number" min="1" placeholder="1"></input>
                                            <?php echo "<b>" . form_error('sales') . "</b>"; ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button type="submit" class="btn btn-sm btn-success"><span class="fas fa-plus"></span> Add</button>
                        </div>
                    </div>
                </div>

                <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
                <script src="<?= base_url(); ?>assets/js/jquery.mask.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.harga_satuan').mask('000.000.000.000.000', {
                            reverse: true
                        });
                    });
                </script>
            </div>
    </section>