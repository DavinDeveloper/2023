<?
$pt = TRUE;
$ps = TRUE;
include '../library/configuration.php';
if ($data_user['verifikasi'] == NULL) {
    header("Location: ".$cf['url']);
}
include '../library/header.php';
?>

<main id="main" class="main">
<div class="row">
        <div class="col-lg-12">
        <?
        if (isset($_POST['verifikasi'])) {
        	$post_code = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['code'],ENT_QUOTES)))));
        	if ($data_user['verifikasi'] != $post_code AND $data_user['verifikasi'] !== NULL) {
        	    echo "<script>alert('Code salah atau kedaluwarsa.')</script>";
        	} else {
        	    $update = mysqli_query($op, "UPDATE users SET verifikasi = NULL WHERE id = '".$data_user['id']."'");
        	    if ($update == TRUE) {
            		header("Location : ".$cf['url']);
        		} else {
        		    echo "<script>alert('Gagal sistem.')</script>";
                }
        	}
        }
        if (isset($_POST['whatsapp'])) {
            whatsapp($data_user['telepon'], 'OP-'.$data_user['verifikasi'].' adalah kode verifikasi akun '.$cf['name'].' anda.');
        	echo "<script>alert('Silahkan cek WhatsApp anda.')</script>";
        }
        if (isset($_POST['email'])) {
            include '../assets/vendor/PHPMailer/classes/class.phpmailer.php';
            email($data_user['email'], 'Admin '.$cf['name'], 'Verifikasi Akun '.$cf['name'], 'OP-'.$data_user['verifikasi'].' adalah kode verifikasi akun '.$cf['name'].' anda.');
        	echo "<script>alert('Silahkan cek Email anda.')</script>";
        }
        ?>
          <div class="card">
              <div class="card-body">
                <h5 class="card-title">Verifikasi Akun</h5>
                <form method="POST">
                  <div class="row mb-3">
                    <label for="code" class="col-12 col-form-label">Masukkan Code</label>
                    <div class="input-group">
                      <div class="col-2">
                      <span class="input-group-text">OP -</span>
                      </div>
                      <div class="col-8">
                      <input type="number" name="code" id="code" minlength="6" maxlength="6" class="form-control">
                      </div>
                      <div class="col-2">
                      <button type="submit" name="verifikasi" class="btn btn-primary w-100"><i class="bi bi-telegram"></i></button>
                      </div>
                    </div>
                  </div>
        
              <div class="row mb-3">
                <div class="col-sm-12">
                  <button type="submit" name="email" class="btn btn-danger">Email</button>
                  <button type="submit" name="whatsapp" class="btn btn-success">Whatsapp</button>
                </div>
              </div>
            </form>
          </div>
        </div>  

        </div>
</div>
</main>

<? include '../library/footer.php'; ?>