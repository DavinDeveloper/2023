<?
$ps = TRUE;
include '../library/configuration.php';
include '../library/header.php';
?>

<main id="main" class="main">
<div class="row">
        <div class="col-lg-12">
        <?
        if (isset($_POST['ubah'])) {
        	$post_password_lama = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['password_lama'],ENT_QUOTES)))));
        	$post_password_baru = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['password_baru'],ENT_QUOTES)))));
	        $hash_password = password_hash($post_password_baru, PASSWORD_DEFAULT, array('cost' => 10));
        	if (!password_verify($post_password_lama, $data_user['password'])) {
        	    echo "<script>alert('Password lama salah.')</script>";
        	} else {
        	    $update = mysqli_query($op, "UPDATE users SET password = '$hash_password', unhash = '$post_password_baru' WHERE id = '".$data_user['id']."'");
                if ($update == TRUE) {
        	        echo '<script>alert("Password berhasil diubah.");window.location.href="'.$cf['url'].'auth/setting";</script>';
                    whatsapp($data_user['telepon'], 'Password akun '.$cf['name'].' anda baru saja diubah. Pastikan ini adalah anda, jika ini bukan anda amankan akun anda sekarang.');
                    include '../assets/vendor/PHPMailer/classes/class.phpmailer.php';
                    email($data_user['email'], "Password akun ".$cf['name']." telah diubah", "Password akun ".$cf['name']." anda telah diubah. Pastikan ini adalah anda, jika ini bukan anda amankan akun anda sekarang.");
        		} else {
        		    echo "<script>alert('Gagal sistem.')</script>";
                }
        	}
        }
        ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ganti Password</h5>
              <form method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="password_lama" class="col-sm-12 col-form-label">Password Lama</label>
                  <div class="input-group mb-3">
                    <input type="text" name="password_lama" id="password_lama" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="password_baru" class="col-sm-12 col-form-label">Password Baru</label>
                  <div class="input-group mb-3">
                    <input type="text" name="password_baru" id="password_baru" class="form-control">
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                  </div>
                </div>
              </form>

            </div>
          </div>

        </div>
</div>
</main>

<? include '../library/footer.php'; ?>