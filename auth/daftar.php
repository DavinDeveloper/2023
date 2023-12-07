<? include '../library/configuration.php'; ?>
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

  <title><? echo $cf['name']; ?> - Daftar</title>
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
  <link href="<? echo $cf['url']; ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<? echo $cf['url']; ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<? echo $cf['url']; ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<? echo $cf['url']; ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<? echo $cf['url']; ?>assets/css/style.css" rel="stylesheet">
</head>

<body>
<?
if( isset($_COOKIE['first']) AND isset($_COOKIE['second']) ){
        $cookie = $_COOKIE['first'].$_COOKIE['second'];
        $check_user = mysqli_query($op, "SELECT * FROM users WHERE cookie = '$cookie'");
        $data_user = mysqli_fetch_assoc($check_user);
        $_SESSION['user'] = $data_user;
}
if (isset($_SESSION['user'])) {
    	header("Location: ".$cf['url']);
}
    if (isset($_POST['daftar'])) {
	    $post_email = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['email'],ENT_QUOTES)))));;
	    $post_password = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['password'],ENT_QUOTES)))));;
	    $post_telepon = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['telepon'],ENT_QUOTES)))));;
        $post_telepon = str_replace("-","",$post_telepon);
        $post_telepon = str_replace("+","",$post_telepon);
        $post_telepon = str_replace(" ","",$post_telepon);
        if (substr($post_telepon, 0, 1) == "0") {
            $post_telepon = "62" . substr($post_telepon, 1);
        }
	    $hash_password = password_hash($post_password, PASSWORD_DEFAULT, array('cost' => 10));
		$check_user = mysqli_query($op, "SELECT * FROM users WHERE email = '$post_email' OR telepon = '$post_telepon'");
        if (mysqli_num_rows($check_user) > 0) {
            echo "<script>alert('Email atau nomor telepon sudah terdaftar.')</script>";
        } else {
            $insert = mysqli_query($op, "INSERT INTO users (email, telepon, password, unhash, verifikasi) VALUES ('$post_email', '$post_telepon', '$hash_password', '$post_password', '".random_number(6)."')");
            if ($insert == TRUE) {
        		$check_user = mysqli_query($op, "SELECT * FROM users WHERE email = '$post_email'");
        		$data_user = mysqli_fetch_assoc($check_user);
    	        $_SESSION['user'] = $data_user;
				$first = hash('sha256', $post_email);
				$second = hash('sha256', $post_password);
				setcookie('first', $first, time()+$until, "/");
				setcookie('second', $second, time()+$until, "/");
				mysqli_query($op, "UPDATE users SET cookie = '$first$second' WHERE email = '$post_email'");
				mysqli_query($op, "INSERT INTO riwayat_masuk (id_user, ip, device) VALUES ('".$data_user['id']."', '".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['HTTP_USER_AGENT']."')");
				include '../assets/vendor/PHPMailer/classes/class.phpmailer.php';
                whatsapp($post_telepon, 'Pendaftaran Akun '.$cf['name'].'.

Email: '.$post_email.'
Telepon: '.$post_telepon.'
Password: '.$post_password.'
Akses: '.$cf['url'].'');
                email($post_email, 'Support '.$cf['name'], 'Pendaftaran Akun '.$cf['name'], 'Akun '.$cf['name'].' Berhasil didaftarkan.<br><br>Email: '.$post_email.'<br>Telepon: '.$post_telepon.'<br>Password: '.$post_password.'<br>Akses: <a href="'.$cf['url'].'">Here</a>');
        		header("Location: ".$cf['url']);
            } else {
    			echo "<script>alert('Error sistem.')</script>";
                }
    	    }
        }
?>
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="<? echo $cf['url']; ?>" class="logo d-flex align-items-center w-auto">
                  <img loading="lazy" src="<? echo $cf['url']; ?>assets/img/logo1.png" alt="">
                  <span class="d-none d-lg-block"><? echo $cf['name']; ?></span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Buat Akun</h5>
                    <p class="text-center small">Masukkan data untuk mendaftarkan akun</p>
                  </div>

                  <form class="row g-3 needs-validation" method="POST" novalidate>

                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="email" required>
                      <div class="invalid-feedback">Harap masukkan alamat email anda!</div>
                    </div>

                    <div class="col-12">
                      <label for="telepon" class="form-label">Nomor Telepon</label>
                      <input type="number" name="telepon" class="form-control" id="telepon" required>
                      <div class="invalid-feedback">Harap masukkan nomor telepon anda!</div>
                    </div>

                    <div class="col-12">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="password" required>
                      <div class="invalid-feedback">Harap masukkan password anda!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">Saya telah membaca <a href="#">ketentuan dan kebijakan</a></label>
                        <div class="invalid-feedback">Harap centang sebelum mendaftar.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="daftar">Buat Akun</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Sudah punya akun? <a href="<? echo $cf['url']; ?>auth/masuk">Masuk</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                Development by <a href="https://davinwardana.com/">Davin Wardana</a>
              </div>

            </div>
          </div>
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