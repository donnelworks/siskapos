<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Body Section -->
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="bx bx-menu bx-sm"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="bx bx-fullscreen bx-sm"></i>
          </a>
        </li>

      </ul>

      <!-- SEARCH FORM -->
      <!-- <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form> -->

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="bx bx-bell bx-sm bx-tada"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>

        <!-- User Dropdown Menu -->
        <li class="nav-item dropdown user-menu">
          <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" aria-expanded="false">
            <?php if ($this->fungsi->user()->foto == null){ ?>
              <img src="<?= base_url() ?>assets/dist/img/user-01.jpg" class="user-image img-circle elevation-0" alt="User">
            <?php } else { ?>
              <img src="<?= base_url() ?>files/upload/img/user/<?= $this->fungsi->user()->foto ?>" class="user-image img-circle elevation-0" alt="User">
            <?php } ?>
          </a>
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="left: inherit; right: 0px;">
            <span class="dropdown-header">
              <strong><?= $this->fungsi->user()->nama ?></strong> <br>
              <?= $this->fungsi->role() ?>
            </span>
            <div class="dropdown-divider"></div>
            <a href="<?= site_url("utilitas/profile") ?>" class="dropdown-item">
              <i class="bx bx-user-circle mr-2"></i> Profile
            </a>
            <!-- <a href="javascript:void(0)" class="dropdown-item">
              <i class="bx bx-cog mr-2"></i> Pengaturan
            </a> -->
            <div class="dropdown-divider"></div>
            <a href="<?= site_url("auth/logout") ?>" class="dropdown-item mb-2">
              <i class="bx bx-power-off mr-2"></i> Keluar
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->
