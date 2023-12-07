<!DOCTYPE html>
<html lang="id">
<!--
         _____          __        __  _____   ___    __
        |  __ \     /\  \ \      / / |_   _| |   \   | |
        | |  | |   /  \  \ \    / /    | |   | |\ \  | |
        | |  | |  / /\ \  \ \  / /     | |   | | \ \ | |
        | |__| | / /__\ \  \ \/ /     _| |_  | |  \ \| |
        |_____/ /_/    \_\  \__/     |_____| |_|   \___|
        
    DEVELOPED BY DAVIN WARDANA (DAVIN.ID / DAVINWARDANA.COM)
    
-->
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="Cache-control" content="public, max-age=2592000">

  <title><? echo $cf['name']; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<? echo $cf['url']; ?>assets/img/logo1.png" rel="icon">
  <link href="<? echo $cf['url']; ?>assets/img/logo1.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<? echo $cf['url']; ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<? echo $cf['url']; ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<? echo $cf['url']; ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<? echo $cf['url']; ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<? echo $cf['url']; ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">
  
  <!-- Custom CSS -->
  <? if (!empty($css)) { echo $css; } ?>

  <!-- Template Main CSS File -->
  <!--<link href="<? echo $cf['url']; ?>assets/css/putih.css" rel="stylesheet">-->
  <link href="<? echo $cf['url']; ?>assets/css/biru.css" rel="stylesheet">
</head>

<body onload="getLocation();">

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="<? echo $cf['url']; ?>" class="logo d-flex align-items-center">
        <!--<span class="d-none d-lg-block"><? echo $cf['name']; ?></span>-->
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <div class="brand-name">
        <span>&emsp;&emsp;<a href="<? echo $cf['url']; ?>" style="color:white;"><? echo $cf['name']; ?></a></span>
    </div>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <? if (isset($_SESSION['user'])) { ?>
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img loading="lazy" src="<? echo $cf['url']; ?>assets/img/logo.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><? if (empty($data_user['nama'])) { echo ''; } else { echo $data_user['nama']; } ?></span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><? if (empty($data_user['nama'])) { echo ''; } else { echo $data_user['nama']; } ?></h6>
              <span><? echo $data_user['level']; ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <? if ($data_user['level'] == 'Driver') { ?>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<? echo $cf['url']; ?>driver/topup-saldo">
                <i>Rp</i>
                <span><? echo number_format($data_user['saldo'],0,',','.'); ?></span>
              </a>
            </li>
            <? } ?>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<? echo $cf['url']; ?>auth/setting">
                <i class="bi bi-gear"></i>
                <span>Pengaturan</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<? echo $cf['url']; ?>page/help">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<? echo $cf['url']; ?>page/group">
                <i class="bi bi-people"></i>
                <span>Join Group</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<? echo $cf['url']; ?>page/chat">
                <i class="bi bi-chat-left-dots"></i>
                <span><? if ($_SESSION['chat'] == TRUE) { ?>Nonaktifkan<? } else { ?>Aktifkan<? } ?> Live Chat</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<? echo $cf['url']; ?>auth/keluar">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
              </a>
            </li>

          </ul>
        </li>
        <? } ?>
      </ul>
    </nav>

  </header>

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
    
    <? if (isset($_SESSION['user'])) { ?>
      <li class="nav-item">
        <a class="nav-link <? if ($sf != $cf['url'] AND $sf != $cf['url'].'admin/' AND $sf != $cf['url'].'driver/' AND $sf != $cf['url'].'developer/') { echo 'collapsed'; } ?>" href="<? echo $cf['url']; ?>">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      
    <? if ($data_user['level'] == 'Developer') { ?>
    <? } ?>
      
    <? if ($data_user['level'] == 'Customer') { ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#customer-pesanan-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-cart2"></i><span>Pesanan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="customer-pesanan-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<? echo $cf['url']; ?>customer/riwayat">
              <i class="bi bi-circle"></i><span>Riwayat Pesanan</span>
            </a>
          </li>
        </ul>
      </li>
    <? } ?>
    
    <? if ($data_user['level'] == 'Driver') { ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#driver-saldo-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-currency-dollar"></i><span>Saldo</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="driver-saldo-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<? echo $cf['url']; ?>driver/topup">
              <i class="bi bi-circle"></i><span>Riwayat Topup Saldo</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#driver-pesanan-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-cart2"></i><span>Pesanan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="driver-pesanan-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<? echo $cf['url']; ?>driver/riwayat">
              <i class="bi bi-circle"></i><span>Riwayat Pesanan</span>
            </a>
            <a href="<? echo $cf['url']; ?>driver/penghasilan">
              <i class="bi bi-circle"></i><span>Riwayat Penghasilan</span>
            </a>
          </li>
        </ul>
      </li>
    <? } ?>
    
    <? if ($data_user['level'] == 'Admin') { ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#admin-customer-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person"></i><span>Customer</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="admin-customer-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<? echo $cf['url']; ?>admin/customer">
              <i class="bi bi-circle"></i><span>Data Customer</span>
            </a>
            <a href="<? echo $cf['url']; ?>admin/customer/pending">
              <i class="bi bi-circle"></i><span>Data Customer Pending</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#admin-driver-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-square"></i><span>Driver</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="admin-driver-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<? echo $cf['url']; ?>admin/driver">
              <i class="bi bi-circle"></i><span>Data Driver</span>
            </a>
            <a href="<? echo $cf['url']; ?>admin/driver/pending">
              <i class="bi bi-circle"></i><span>Data Driver Pending</span>
            </a>
            <a href="<? echo $cf['url']; ?>admin/driver/topup">
              <i class="bi bi-circle"></i><span>Topup Saldo</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#admin-destinasi-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-geo-alt"></i><span>Destinasi</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="admin-destinasi-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<? echo $cf['url']; ?>admin/destinasi">
              <i class="bi bi-circle"></i><span>Destinasi Kampus</span>
            </a>
            <a href="<? echo $cf['url']; ?>admin/destinasi/lain">
              <i class="bi bi-circle"></i><span>Destinasi Lain</span>
            </a>
            <a href="<? echo $cf['url']; ?>admin/destinasi/restoran">
              <i class="bi bi-circle"></i><span>Destinasi Restoran</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<? echo $cf['url']; ?>admin/pesanan">
          <i class="bi bi-cart3"></i>
          <span>Pesanan & Feedback</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<? echo $cf['url']; ?>admin/restoran">
          <i class="bi bi-basket"></i>
          <span>Restoran</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<? echo $cf['url']; ?>admin/iklan">
          <i class="bi bi-grid"></i>
          <span>Iklan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<? echo $cf['url']; ?>admin/pembayaran">
          <i class="bi bi-wallet"></i>
          <span>Metode Pembayaran</span>
        </a>
      </li>
      <!--<li class="nav-item">-->
      <!--  <a class="nav-link collapsed" href="<? echo $cf['url']; ?>admin/paket">-->
      <!--    <i class="bi bi-box-seam"></i>-->
      <!--    <span>Kategori Paket</span>-->
      <!--  </a>-->
      <!--</li>-->
    <? } } else { ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="<? echo $cf['url']; ?>auth/masuk">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Masuk</span>
        </a>
    </li>
    <? } ?>
    </ul>

  </aside><!-- End Sidebar-->