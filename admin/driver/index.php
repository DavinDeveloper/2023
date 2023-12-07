<?
$pl = 'Admin';
$ps = TRUE;
$css .= '
<link href="'.$cf['url'].'assets/vendor/simple-datatables/style.css" rel="stylesheet">';
include '../../library/configuration.php'; 
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
            $insert = mysqli_query($op, "INSERT INTO users (email, telepon, password, unhash, level, verifikasi) VALUES ('$post_email', '$post_telepon', '$hash_password', '$post_password', 'Driver', '".random_number(6)."')");
            if ($insert == TRUE) {
                include '../../assets/vendor/PHPMailer/classes/class.phpmailer.php';
                whatsapp($post_telepon, 'Akun Driver Berhasil didaftarkan.

Email: '.$post_email.'
Telepon: '.$post_telepon.'
Password: '.$post_password.'
Akses: '.$cf['url'].'');
                email($post_email, 'Admin '.$cf['name'], 'Pendaftaran Akun Driver '.$cf['name'], 'Akun Driver Berhasil didaftarkan.<br><br>Email: '.$post_email.'<br>Telepon: '.$post_telepon.'<br>Password: '.$post_password.'<br>Akses: <a href="'.$cf['url'].'">Here</a>');
        		$result = "Akun Driver Berhasil didaftarkan.<br><br>Email: ".$post_email."<br>Telepon: ".$post_telepon."<br>Password: ".$post_password;
            } else {
    			echo "<script>alert('Error sistem.')</script>";
                }
    	    }
        }
include '../../library/header.php';
?>
<main id="main" class="main">
    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
        <? if (!empty($result)) { ?>
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <? echo $result; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <? } ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Driver</h5>
              <p>Manajemen data driver dan pendapatan harian driver.</p>
              <!--<div align="right" class="text-right float-right">-->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#daftarkan">Daftarkan</button>
              <!--</div>-->
                  <div class="modal fade" id="daftarkan" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Daftarkan Driver</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="card">
                        <div class="card-body">
                        <form method="POST">
                            
                        <div class="row mb-3">
                          <label for="email" class="col-sm-12 col-form-label">Email</label>
                          <div class="col-sm-12">
                            <input type="email" name="email" id="email" class="form-control" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="telepon" class="col-sm-12 col-form-label">Nomor Telepon</label>
                          <div class="col-sm-12">
                            <input type="number" name="telepon" id="telepon" class="form-control" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="password" class="col-sm-12 col-form-label">Password</label>
                          <div class="col-sm-12">
                            <input type="password" name="password" id="password" class="form-control" required>
                          </div>
                        </div>
                        
                        </div></div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" name="daftar" class="btn btn-primary">Daftarkan</button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
              <!-- Table with stripped rows -->
              <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">WhatsApp</th>
                    <th scope="col">Identitas</th>
                    <th scope="col">Wajah</th>
                    <th scope="col">Motor</th>
                    <th scope="col">Warna Motor</th>
                    <th scope="col">Plat Motor</th>
                    <th scope="col">Hari Ini</th>
                    <th scope="col">Penghasilan</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <? 
                $no = 1;
                if (isset($_POST['suspend'])) {
                    mysqli_query($op, "UPDATE users SET status = 'Suspend' WHERE id = '".$_POST['id']."'");
                    header("Location: ".$cf['url']."admin/driver");
                }
                if (isset($_POST['unsuspend'])) {
                    mysqli_query($op, "UPDATE users SET status = 'Active' WHERE id = '".$_POST['id']."'");
                    header("Location: ".$cf['url']."admin/driver");
                }
                $check_driver = mysqli_query($op, "SELECT * FROM users WHERE level = 'Driver' AND upload = 'Confirmed' AND status != 'Pending'"); 
                while($data_driver = mysqli_fetch_assoc($check_driver)) {
                    $check_pendapatan = mysqli_query($op, "SELECT SUM(harga) as total_pendapatan FROM pesanan WHERE id_driver = '".$data_driver['id']."' AND status = 'Selesai' AND DATE(created) = '".date("Y-m-d")."'");
                    $data_pendapatan = mysqli_fetch_assoc($check_pendapatan);
                ?>
                  <tr>
                    <th scope="row"><? echo $no++; ?></th>
                    <td><? echo $data_driver['nama']; ?></td>
                    <td><? echo $data_driver['email']; ?></td>
                    <td><? echo $data_driver['telepon']; ?></td>
                    <td><a href="<? echo $data_driver['identitas']; ?>" target="_blank">Check</a></td>
                    <td><a href="<? echo $data_driver['driver_face']; ?>" target="_blank">Check</a></td>
                    <td><? echo $data_driver['driver_merk']; ?></td>
                    <td><? echo $data_driver['driver_warna']; ?></td>
                    <td><? echo $data_driver['driver_plat']; ?></td>
                    <td>Rp<? echo number_format($data_pendapatan['total_pendapatan'] ? $data_pendapatan['total_pendapatan'] : 0,0,',','.'); ?></td>
                    <td><a href="<? echo $cf['url']; ?>admin/driver/penghasilan?1=<? echo $data_driver['id']; ?>" class="btn btn-primary">Lihat</a></td>
                    <td>
                    <form method="POST">
                    <input name="id" value="<? echo $data_driver['id']; ?>" hidden>
                    <? if ($data_driver['status'] == 'Active') { ?>
                    <button type="submit" name="suspend" class="btn btn-danger">Suspend</button>
                    <? } else { ?>
                    <button type="submit" name="unsuspend" class="btn btn-success">Unsuspend</button>
                    <? } ?>
                    </form>
                    </td>
                  </tr>
                <? } ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
             </div>
            </div>
          </div>

        </div>
      </div>
    </section>
    
</main>

<? 
$js .= '
<script src="'.$cf['url'].'assets/vendor/simple-datatables/simple-datatables.js"></script>';
include '../../library/footer.php'; ?>