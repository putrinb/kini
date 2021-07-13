<div class="wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php if ($this->session->flashdata('flash')) : ?>
                <div class="div row mt-3">
                    <div class="div col md-3">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Data <strong> berhasil </strong><?= $this->session->flashdata('flash'); ?>!
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mt-2">Data Harga Pokok Penjualan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Pokok Penjualan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data_bom as $cacah) :
                                        echo "<tr>";
                                        echo "<td class='text-center'>" . $no++;
                                        "</td>";
                                        // echo "<td>".$cacah['id_bom']."</td>";                                    
                                        echo "<td>" . $cacah['id_minum'] . "</td>";
                                        echo "<td>" . $cacah['nama_minum'] . "</td>";
                                        echo "<td>" . format_rp($cacah['harga']) . "</td>";
                                    ?>
                                        <td class="text-center">
                                            <button onclick="location.href = '<?php echo site_url('produksi/view_data_detail/' . $cacah['id_bom'] . '/' . $cacah['id_minum']) ?>'" type="button" class="btn btn-info btn-sm">
                                                <span class="fas fa-eye"></span>
                                            </button>
                                        <?php
                                        echo "</td>";
                                        echo "</tr>";
                                    endforeach;
                                        ?>
                                </tbody>
                            </table>
                            <!-- DataTables -->
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>