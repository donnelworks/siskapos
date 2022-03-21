<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-dark bg-primary">
  <!-- Brand Logo -->
  <a href="javascript:void(0)" class="brand-link">
    <img src="<?= base_url() ?>assets/dist/img/logo/logo-white.svg" alt="" class="brand-image">
    <span class="brand-text font-weight-light">
      <img src="<?= base_url() ?>assets/dist/img/logo/logo-type-white.svg" alt="" class="brand-image-text">
    </span>
    <!-- <span class="brand-text font-weight-light">SISKASOFT</span> -->
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- SidebarSearch Form -->
    <!-- <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div> -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?= site_url("dashboard") ?>" class="nav-link d-flex align-items-center">
            <i class="nav-icon bx bx-home"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= site_url("produk") ?>" class="nav-link d-flex align-items-center">
            <i class="nav-icon bx bx-package"></i>
            <p>Produk</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= site_url("konsumen") ?>" class="nav-link d-flex align-items-center">
            <i class="nav-icon bx bx-user-circle"></i>
            <p>Konsumen</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="javascript.void(0)" class="nav-link d-flex align-items-center">
            <i class="nav-icon bx bx-receipt"></i>
            <p>
              Transaksi
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= site_url('transaksi/proses_tagihan') ?>" class="nav-link d-flex align-items-center">
                <i class="bx bx-radio-circle nav-icon"></i>
                <p>Proses Tagihan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('transaksi/pembayaran') ?>" class="nav-link d-flex align-items-center">
                <i class="bx bx-radio-circle nav-icon"></i>
                <p>Pembayaran</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="javascript.void(0)" class="nav-link d-flex align-items-center">
            <i class="nav-icon bx bx-clipboard"></i>
            <p>
              Laporan
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= site_url('laporan/lap_pembayaran') ?>" class="nav-link d-flex align-items-center">
                <i class="bx bx-radio-circle nav-icon"></i>
                <p>Lap. Pembayaran</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('laporan/lap_penjualan') ?>" class="nav-link d-flex align-items-center">
                <i class="bx bx-radio-circle nav-icon"></i>
                <p>Lap. Penjualan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('laporan/lap_komisi') ?>" class="nav-link d-flex align-items-center">
                <i class="bx bx-radio-circle nav-icon"></i>
                <p>Lap. Komisi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('laporan/lap_status_tagihan') ?>" class="nav-link d-flex align-items-center">
                <i class="bx bx-radio-circle nav-icon"></i>
                <p>Lap. Status Tagihan</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="<?= site_url("utilitas/user") ?>" class="nav-link d-flex align-items-center">
            <i class="nav-icon bx bx-user"></i>
            <p>Pengguna</p>
          </a>
        </li>

        <!--
        <li class="nav-header">MULTI LEVEL EXAMPLE</li>

        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.html" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v1</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index2.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v2</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index3.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v3</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              Level 1
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Level 2</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Level 2
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Level 3</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Level 3</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Level 3</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Level 2</p>
              </a>
            </li>
          </ul>
        </li> -->
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
