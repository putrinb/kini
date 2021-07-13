<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-info elevation-4">
  <!-- Brand Logo -->
  <a href="<?= base_url(); ?>" class="brand-link navbar-light">
    <img src="<?= base_url(); ?>assets/dist/img/logo_kini.png" alt="Kini Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Kini Cheese Tea</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url(); ?>assets/dist/img/avatar2.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <!-- <small style="color:white">Logged in as:</small> -->
        <a href="#" class="d-block">
          <div class="small">Logged in as:</div><?= $this->session->userdata('role_label') ?>
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
          <a href="<?= site_url('dashboard') ?>" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <?php if($this->session->userdata('role') == 1 ) { ?>
        <li class="nav-header">MASTER DATA</li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-archive"></i>
            <p>
              Bahan Baku Utama
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= site_url('bahan_baku/add') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tambah Data</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('bahan_baku/view_data') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Lihat Data</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-beer"></i>
            <p>Produk
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <!-- <li class="nav-item">
              <a href="<?= site_url('produk/add') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tambah Data</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="<?= site_url('produk/view_data') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Lihat Data</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p class="font-italic">Bill of Material
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= site_url('bom/add') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tambah Data</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('bom/view_data') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Lihat Data</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>Daftar Operasional
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= site_url('operasional/add') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tambah Data</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('operasional/view_data') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Lihat Data</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header">TRANSAKSI</li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-boxes"></i>
            <p>
              Penerimaan
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= site_url('penerimaan/add') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tambah Data</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('penerimaan/view_data') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Lihat Data</p>
              </a>
            </li>
          </ul>
        </li>
        
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-boxes"></i>
            <p>
              Produksi
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= site_url('produksi/view') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Pesanan</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= site_url('produksi/daftar_hpp') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar HPP Produk</p>
              </a>
            </li>
          </ul>
        </li>
        <?php } ?>
        
        <?php if($this->session->userdata('role') == 2 ) { ?>
        <li class="nav-header">LAPORAN</li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Laporan
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= site_url('laporan'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan Penerimaan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('laporan/KartuStok'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Kartu Stok</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('laporan/hpp'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Harga Pokok Penjualan</p>
              </a>
            </li>
          </ul>
        </li> <?php } ?>
  </div>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1 class="m-0 text-dark"><?= $heading ?></h1> -->
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><?= $heading ?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->