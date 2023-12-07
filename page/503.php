<?
$pt = TRUE;
include '../library/configuration.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Maintenance 503</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<? echo $cf['url']; ?>assets/img/favicon.png" rel="icon">
  <link href="<? echo $cf['url']; ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<? echo $cf['url']; ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<? echo $cf['url']; ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<? echo $cf['url']; ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<? echo $cf['url']; ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<? echo $cf['url']; ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<? echo $cf['url']; ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<? echo $cf['url']; ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<? echo $cf['url']; ?>assets/css/style.css" rel="stylesheet">
</head>

<body>

  <main>
    <div class="container">

      <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h1>503</h1>
        <h2>Website Maintenance.</h2>
        <a class="btn" href="<? echo $cf['url']; ?>">Back to home</a>
        <img src="<? echo $cf['url']; ?>assets/img/not-found.svg" class="img-fluid py-5" alt="Page Not Found">
        <div class="credits">
          Designed by <a href="https://davinwardana.com/" target="_BLANK">Davin Wardana</a>
        </div>
      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<? echo $cf['url']; ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<? echo $cf['url']; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<? echo $cf['url']; ?>assets/vendor/chart.js/chart.umd.js"></script>
  <script src="<? echo $cf['url']; ?>assets/vendor/echarts/echarts.min.js"></script>
  <script src="<? echo $cf['url']; ?>assets/vendor/quill/quill.min.js"></script>
  <script src="<? echo $cf['url']; ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<? echo $cf['url']; ?>assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="<? echo $cf['url']; ?>assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<? echo $cf['url']; ?>assets/js/main.js"></script>

</body>

</html>