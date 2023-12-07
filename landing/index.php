<? 
session_start();
include '../library/configuration.php';
if (isset($_COOKIE['first']) AND isset($_COOKIE['second'])) {
    $cookie = $_COOKIE['first'].$_COOKIE['second'];
    $check_user = mysqli_query($op, "SELECT * FROM users WHERE cookie = '$cookie'");
    if (mysqli_num_rows($check_user) == 0) {
        header("Location: ".$cf['url']."auth/keluar");
    } else {
    $data_user = mysqli_fetch_assoc($check_user);
    $_SESSION['user'] = $data_user;
	$first = hash('sha256', $data_user['email']);
	$second = hash('sha256', $data_user['unhash']);
	setcookie('first', $first, time()+$until, "/");
	setcookie('second', $second, time()+$until, "/");
	header("Location: ".$cf['url']);
	}
}
if (isset($_SESSION['user'])) {
    header("Location: ".$cf['url']);
}
?>
<!DOCTYPE html>
<html lang="en">
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

  <title><? echo $cf['name']; ?></title>
  <meta content="Ngampus bareng <? echo $cf['name']; ?>" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<? echo $cf['url']; ?>assets/img/logo1.png" rel="icon">
  <link href="<? echo $cf['url']; ?>assets/img/logo1.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
<style>
    #splash {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url('../assets/img/splash.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      z-index: 9999;
    }
    @media (max-width: 767px) {
      #splash {
        display: block;
      }
    }
    @media (min-width: 768px) {
      #splash {
        display: none;
      }
    }
  </style>
</head>

<body>
<div id="splash"></div>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1><a href="<? echo $cf['url']; ?>"><span><? echo $cf['name']; ?></span></a></h1>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Utama</a></li>
          <li><a class="nav-link scrollto" href="#about">Tentang</a></li>
          <li><a class="nav-link scrollto" href="#features">Fitur</a></li>
          <li><a class="nav-link scrollto" href="#team">Tim</a></li>
          <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">

    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
          <div data-aos="zoom-out">
            <h1>Ngampus bareng <span><? echo $cf['name']; ?></span></h1>
            <h2>Ayo pesan <? echo $cf['name']; ?> sekarang juga!</h2>
            <div class="text-center text-lg-start">
              <a href="<? echo $cf['url']; ?>auth/daftar" class="btn-get-started scrollto">Daftar</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
          <img loading="lazy" src="assets/img/hero-img.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
      <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
      </g>
      <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
      </g>
      <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
      </g>
    </svg>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container-fluid">

        <div class="row">
          <!--<div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch" data-aos="fade-right">-->
          <!--  <a href="https://www.youtube.com/watch?v=krASibHJ_Hk" class="glightbox play-btn mb-4"></a>-->
          <!--</div>-->

          <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5" data-aos="fade-left">
            <h3>Apasih <? echo $cf['name']; ?> itu?</h3>
            <p>Ojek Kampus (<? echo $cf['name']; ?>) merupakan sarana transportasi khusus mahasiswa UIN Bandung yang menyediakan berbagai jasa layanan.</p>
            <!--<div class="col-3">-->
            <!--  <a href="<? echo $cf['url']; ?>assets/file/Opus.apk" class="btn btn-outline-primary">Download</a>-->
            <!--</div>-->

            <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon"><i class="bi bi-building"></i></div>
              <h4 class="title"><a href="">Perkuliahan</a></h4>
              <p class="description">Mengantarkan ke berbagai rute sekitar kampus 1/2 dan sebaliknya</p>
            </div>

            <div class="icon-box" data-aos="zoom-in" data-aos-delay="200">
              <div class="icon"><i class="bi bi-cloud-sun"></i></div>
              <h4 class="title"><a href="">Healing</a></h4>
              <p class="description">Menemani perjalanan healing kapanpun dan kemanapun yang mahasiswa inginkan.</p>
            </div>

            <div class="icon-box" data-aos="zoom-in" data-aos-delay="300">
              <div class="icon"><i class="bi bi-pin-map"></i></div>
              <h4 class="title"><a href="">Pengantaran</a></h4>
              <p class="description">Mengantarkan kemanapun mahasiswa inginkan diluar rute perkuliahan</p>
            </div>

          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Fitur Kami</h2>
          <p>Ayo Coba Semua Fitur <? echo $cf['name']; ?>!</p>
        </div>

        <div class="row" data-aos="fade-left">
          <div class="col-lg-3 col-md-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="50">
              <!--<i class="ri-store-line" style="color: #ffbb2c;"></i>-->
              <h3><a href="">Berangkat Kampus</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="50">
              <!--<i class="ri-store-line" style="color: #ffbb2c;"></i>-->
              <h3><a href="">Pulang Kampus</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="50">
              <!--<i class="ri-store-line" style="color: #ffbb2c;"></i>-->
              <h3><a href="">Healing</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="50">
              <!--<i class="ri-store-line" style="color: #ffbb2c;"></i>-->
              <h3><a href="">Destinasi Lain</a></h3>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Features Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">

        <div class="row" data-aos="fade-up">

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-emoji-smile"></i>
              <span data-purecounter-start="0" data-purecounter-end="<? echo mysqli_num_rows(mysqli_query($op, "SELECT * FROM users WHERE level = 'Customer'"))+35; ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Pengguna</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
            <div class="count-box">
              <i class="bi bi-journal-richtext"></i>
              <span data-purecounter-start="0" data-purecounter-end="<? echo mysqli_num_rows(mysqli_query($op, "SELECT * FROM pesanan WHERE status = 'Selesai'"))+20; ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Perjalanan</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="bi bi-headset"></i>
              <span data-purecounter-start="0" data-purecounter-end="<? echo mysqli_num_rows(mysqli_query($op, "SELECT * FROM riwayat_penilaian"))+20; ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Masukan</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="bi bi-people"></i>
              <span data-purecounter-start="0" data-purecounter-end="<? echo mysqli_num_rows(mysqli_query($op, "SELECT * FROM users WHERE level = 'Driver'")); ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Driver</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Details Section ======= -->
    <section id="details" class="details">
      <div class="container">

        <div class="row content">
          <div class="col-md-4" data-aos="fade-right">
            <img loading="lazy" src="assets/img/details-1.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-8 pt-4" data-aos="fade-up">
            <h3>Keunggulan <? echo $cf['name']; ?></h3>
            <p class="fst-italic">
              Dengan <? echo $cf['name']; ?> kamu bisa mendapatkan :
            </p>
            <ul>
              <li><i class="bi bi-check"></i> Pengantaran gesit dan amanah.</li>
              <li><i class="bi bi-check"></i> Harga terjangkau, dibawah rata-rata ojol.</li>
              <li><i class="bi bi-check"></i> Efisien dan efektif.</li>
              <li><i class="bi bi-check"></i> Aman, karena driver internal mahasiswa UIN.</li>
            </ul>
            <p>
              
            </p>
          </div>
        </div>

        <div class="row content">
          <div class="col-md-4 order-1 order-md-2" data-aos="fade-left">
            <img loading="lazy" src="assets/img/details-2.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-8 pt-5 order-2 order-md-1" data-aos="fade-up">
            <h3>Berdiri sejak 2023</h3>
            <p class="fst-italic">
              <? echo $cf['name']; ?> sudah berdiri sejak 2023
            </p>
            <p>
              <? echo $cf['name']; ?> sudah dipercaya lebih dari <? echo mysqli_num_rows(mysqli_query($op, "SELECT * FROM users")); ?> pengguna untuk melayani dan mengantarkan mahasiswa kemanapun mereka mau.
            </p>
          </div>
        </div>

      </div>
    </section><!-- End Details Section -->

    <!-- ======= Gallery Section ======= -->
    <!--<section id="gallery" class="gallery">-->
    <!--  <div class="container">-->

    <!--    <div class="section-title" data-aos="fade-up">-->
    <!--      <h2>Gallery</h2>-->
    <!--      <p>Check our Gallery</p>-->
    <!--    </div>-->

    <!--    <div class="row g-0" data-aos="fade-left">-->

    <!--      <div class="col-lg-3 col-md-4">-->
    <!--        <div class="gallery-item" data-aos="zoom-in" data-aos-delay="100">-->
    <!--          <a href="assets/img/gallery/gallery-1.jpg" class="gallery-lightbox">-->
    <!--            <img loading="lazy" src="assets/img/gallery/gallery-1.jpg" alt="" class="img-fluid">-->
    <!--          </a>-->
    <!--        </div>-->
    <!--      </div>-->

    <!--      <div class="col-lg-3 col-md-4">-->
    <!--        <div class="gallery-item" data-aos="zoom-in" data-aos-delay="150">-->
    <!--          <a href="assets/img/gallery/gallery-2.jpg" class="gallery-lightbox">-->
    <!--            <img loading="lazy" src="assets/img/gallery/gallery-2.jpg" alt="" class="img-fluid">-->
    <!--          </a>-->
    <!--        </div>-->
    <!--      </div>-->

    <!--      <div class="col-lg-3 col-md-4">-->
    <!--        <div class="gallery-item" data-aos="zoom-in" data-aos-delay="200">-->
    <!--          <a href="assets/img/gallery/gallery-3.jpg" class="gallery-lightbox">-->
    <!--            <img loading="lazy" src="assets/img/gallery/gallery-3.jpg" alt="" class="img-fluid">-->
    <!--          </a>-->
    <!--        </div>-->
    <!--      </div>-->

    <!--      <div class="col-lg-3 col-md-4">-->
    <!--        <div class="gallery-item" data-aos="zoom-in" data-aos-delay="250">-->
    <!--          <a href="assets/img/gallery/gallery-4.jpg" class="gallery-lightbox">-->
    <!--            <img loading="lazy" src="assets/img/gallery/gallery-4.jpg" alt="" class="img-fluid">-->
    <!--          </a>-->
    <!--        </div>-->
    <!--      </div>-->

    <!--      <div class="col-lg-3 col-md-4">-->
    <!--        <div class="gallery-item" data-aos="zoom-in" data-aos-delay="300">-->
    <!--          <a href="assets/img/gallery/gallery-5.jpg" class="gallery-lightbox">-->
    <!--            <img loading="lazy" src="assets/img/gallery/gallery-5.jpg" alt="" class="img-fluid">-->
    <!--          </a>-->
    <!--        </div>-->
    <!--      </div>-->

    <!--      <div class="col-lg-3 col-md-4">-->
    <!--        <div class="gallery-item" data-aos="zoom-in" data-aos-delay="350">-->
    <!--          <a href="assets/img/gallery/gallery-6.jpg" class="gallery-lightbox">-->
    <!--            <img loading="lazy" src="assets/img/gallery/gallery-6.jpg" alt="" class="img-fluid">-->
    <!--          </a>-->
    <!--        </div>-->
    <!--      </div>-->

    <!--      <div class="col-lg-3 col-md-4">-->
    <!--        <div class="gallery-item" data-aos="zoom-in" data-aos-delay="400">-->
    <!--          <a href="assets/img/gallery/gallery-7.jpg" class="gallery-lightbox">-->
    <!--            <img loading="lazy" src="assets/img/gallery/gallery-7.jpg" alt="" class="img-fluid">-->
    <!--          </a>-->
    <!--        </div>-->
    <!--      </div>-->

    <!--      <div class="col-lg-3 col-md-4">-->
    <!--        <div class="gallery-item" data-aos="zoom-in" data-aos-delay="450">-->
    <!--          <a href="assets/img/gallery/gallery-8.jpg" class="gallery-lightbox">-->
    <!--            <img loading="lazy" src="assets/img/gallery/gallery-8.jpg" alt="" class="img-fluid">-->
    <!--          </a>-->
    <!--        </div>-->
    <!--      </div>-->

    <!--    </div>-->

    <!--  </div>-->
    <!--</section><!-- End Gallery Section -->
<?
$check_pesanan = mysqli_query($op, "SELECT masukan FROM pesanan WHERE masukan != '' AND nilai != '' ORDER BY RAND() LIMIT 10");
if (mysqli_num_rows($check_pesanan) > 0) {
?>
    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container">

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <!--<div class="swiper-slide">-->
            <!--  <div class="testimonial-item">-->
            <!--    <img loading="lazy" src="https://davin.id/assets/images/users/davin.png" class="testimonial-img" alt="">-->
            <!--    <h3>Davin Wardana</h3>-->
            <!--    <h4>Developer</h4>-->
            <!--    <p>-->
            <!--      <i class="bx bxs-quote-alt-left quote-icon-left"></i>-->
            <!--      Bagus-->
            <!--      <i class="bx bxs-quote-alt-right quote-icon-right"></i>-->
            <!--    </p>-->
            <!--  </div>-->
            <!--</div>-->
            
            <?
            while($data_pesanan = mysqli_fetch_assoc($check_pesanan)) {
                $data_pemesan = mysqli_fetch_assoc(mysqli_query($op, "SELECT nama,level FROM users WHERE id = '".$data_pesanan['id_user']."'"));
            ?>
            <div class="swiper-slide">
              <div class="testimonial-item">
                <!--<img loading="lazy" src="https://i.ibb.co/HdM0wwB/IMG-3375.jpg" class="testimonial-img" alt="">-->
                <h3><? echo $data_pemesan['nama']; ?></h3>
                <h4><? echo $data_pemesan['level']; ?></h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  <? echo nl2br(str_replace(‘‘, ‘‘, htmlspecialchars($data_pesanan['masukan']))); ?>
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div>
            <? } ?>

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->
<? } ?>
    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Tim</h2>
          <p><? echo $cf['name']; ?> Corp.</p>
        </div>

        <div class="row" data-aos="fade-left">

          <div class="col-lg-4 col-md-6">
            <div class="member" data-aos="zoom-in" data-aos-delay="100">
              <div class="pic"><img loading="lazy" src="<? echo $cf['url']; ?>assets/images/founder/alvino.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Ahmad Yusuf Alvino</h4>
                <span>Founder</span>
                <div class="social">
                  <a href="https://instagram.com/_ahmadalvino"><i class="bi bi-instagram"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-5 mt-lg-0">
            <div class="member" data-aos="zoom-in" data-aos-delay="300">
              <div class="pic"><img loading="lazy" src="<? echo $cf['url']; ?>assets/images/founder/banu.JPEG" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Banu Paramudya</h4>
                <span>Founder</span>
                <div class="social">
                  <a href="https://instagram.com/paramoedyaanantatoer"><i class="bi bi-instagram"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-5 mt-lg-0">
            <div class="member" data-aos="zoom-in" data-aos-delay="400">
              <div class="pic"><img loading="lazy" src="<? echo $cf['url']; ?>assets/images/founder/abgi.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Abgi Cahya</h4>
                <span>Founder</span>
                <div class="social">
                  <a href="https://instagram.com/whyy_giii"><i class="bi bi-instagram"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Team Section -->
<?
$no = 1;
$check_faq = mysqli_query($op, "SELECT * FROM config_faq WHERE status = 'show'");
if (mysqli_num_rows($check_faq) > 0) {
?>
    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>F.A.Q</h2>
          <p>Frequently Asked Questions</p>
        </div>

        <div class="faq-list">
          <ul>
            
            <? while($data_faq = mysqli_fetch_assoc($check_faq)) { ?>
            <li data-aos="fade-up">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-<? echo $data_faq['id']; ?>"><? echo $data_faq['pertanyaan']; ?> <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-<? echo $data_faq['id']; ?>" class="collapse <? if ($no++ == 1) { echo 'show'; } ?>" data-bs-parent=".faq-list">
                <p>
                  <? echo nl2br(str_replace(‘‘, ‘‘, htmlspecialchars($data_faq['jawaban']))); ?>
                </p>
              </div>
            </li>
            <? } ?>

          </ul>
        </div>

      </div>
    </section><!-- End F.A.Q Section -->
<? } ?>
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Contact</h2>
          <p>Contact Us</p>
        </div>

        <div class="row">

          <div class="col-lg-8" data-aos="fade-right" data-aos-delay="100">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Alamat:</h4>
                <p><? echo $cc['alamat']; ?></p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p><? echo $cc['email']; ?></p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>WhatsApp:</h4>
                <p>+<? echo $cc['telepon']; ?></p>
              </div>

            </div>

          </div>
          <div class="col-lg-4 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="200">
              <div class="row">
              <img loading="lazy" height="350px" src="<? echo $cf['url']; ?>assets/img/logo1.png">
              </div>
          </div>

          <!--<div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="200">-->

          <!--  <form action="forms/contact.php" method="post" role="form" class="php-email-form">-->
          <!--    <div class="row">-->
          <!--      <div class="col-md-6 form-group">-->
          <!--        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>-->
          <!--      </div>-->
          <!--      <div class="col-md-6 form-group mt-3 mt-md-0">-->
          <!--        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--    <div class="form-group mt-3">-->
          <!--      <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>-->
          <!--    </div>-->
          <!--    <div class="form-group mt-3">-->
          <!--      <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>-->
          <!--    </div>-->
          <!--    <div class="my-3">-->
          <!--      <div class="loading">Loading</div>-->
          <!--      <div class="error-message"></div>-->
          <!--      <div class="sent-message">Your message has been sent. Thank you!</div>-->
          <!--    </div>-->
          <!--    <div class="text-center"><button type="submit">Send Message</button></div>-->
          <!--  </form>-->

          <!--</div>-->

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span><? echo $cf['name']; ?></span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Development by <a href="https://davinwardana.com/">Davin Wardana</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>
  <script>
    setTimeout(function(){
      document.getElementById('splash').style.display = 'none';
    }, 4000);
  </script>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>