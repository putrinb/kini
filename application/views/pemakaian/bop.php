<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <!-- general form elements -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Biaya Produksi</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form action="<?php echo site_url('pemakaian/bop') ?>" method="post">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="no_pemakaian">No. Pemakaian:</label>
                                        <input type="text" hidden class="form-control" name="no_pemakaian" readonly value="<?php echo $_SESSION['no_pemakaian']; ?>"><br><?= $_SESSION['no_pemakaian']; ?>
                                        <!-- <?php echo "<b>" . form_error('no_pemakaian') . "</b>"; ?> -->
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal:</label>
                                        <div class="input-group date">
                                            <input type="date" hidden name="tanggal" readonly class="form-control" value="<?php echo $_SESSION['tanggal']; ?>" max="<?= date('Y-m-d') ?>" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div><?= $_SESSION['tanggal']; ?>
                                        <?php echo "<b>" . form_error('tanggal') . "</b>"; ?>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="id_bom">ID BOM:</label></label>
                                        <input readonly hidden class="form-control" name="id_bom" value="<?= $_SESSION['id_bom']; ?>">
                                        </input><br><?= $_SESSION['id_bom']; ?>
                                    </div>
                                </div>
                            </div>

                            <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Biaya Overhead Pabrik</h3>
                </div>

                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-inline form-group mb-1">
                                    <label for="tarif">Tarif dasar listrik<span class="text-danger">*</span></label>
                                    <div class="input-group mb-1 ml-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                        </div>
                                        <input type="text" class="form-control tarif" name="tarif" value="<?= set_value('tarif'); ?>" placeholder="00.000" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div><?php echo "<b>" . form_error('tarif') . "</b>"; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-inline form-group mb-1 mt-3">
                                    <label for="type">Jenis Penggunaan<span class="text-danger">*</span></label>
                                    <select class="form-control form-inline text-center ml-3" name="type">
                                        <option value="">- None -</option>
                                        <option value="cup sealer">Cup Sealer</option>
                                        <option value="blender">Blender</option>
                                        <!-- <?php foreach ($bom as $row) : ?>
                                                <option value="<?php echo $row['kode_bb'] ?>"><?php echo $row['nama_bb'] ?></option>
                                            <?php endforeach; ?> -->
                                    </select>
                                </div><?php echo "<b>" . form_error('type') . "</b>"; ?>
                            </div>

                            <div class="col-sm-6">
                                <div class="input-group form-inline mb-6 ml-3 mt-3">
                                    <label for="lama">Lama Penggunaan (menit)<span class="text-danger">*</span></label>
                                    <div class="input-group mb-6 ml-3">
                                        <input type="text" class="form-control" name="lama" value="<?= set_value('lama'); ?>" type="number" min="1" placeholder="">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon1">menit</span>
                                        </div>
                                    </div><?php echo "<b>" . form_error('lama') . "</b>"; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button type="submit" class="btn btn-sm btn-success"><span class="fas fa-check"></span> Simpan</button>
                        </div>
                    </div>
                    </form>
                </div>

                <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
                <script src="<?= base_url(); ?>assets/js/jquery.mask.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.tarif').mask('000.000.000.000.000', {
                            reverse: true
                        });
                    });
                </script>
            </div>
    </section>