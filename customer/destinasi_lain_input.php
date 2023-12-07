<?
$pl = 'Customer';
$ps = TRUE;
include '../library/configuration.php';
include '../library/header.php';
?>

<main id="main" class="main">
<div class="row">
        <div class="col-lg-12">
        <?
        if (isset($_POST['tambah'])) {
        	$post_destinasi1 = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['destinasi1'],ENT_QUOTES)))));
        	$post_destinasi2 = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['destinasi2'],ENT_QUOTES)))));
        	$check_destinasi = mysqli_query($op, "SELECT * FROM destinasi_lain_input WHERE ((destinasi1 = '$post_destinasi1' AND destinasi2 = '$post_destinasi2') OR (destinasi1 = '$post_destinasi2' AND destinasi2 = '$post_destinasi1')) AND status = 'show'");
        	$data_destinasi = mysqli_fetch_assoc($check_destinasi);
        	if (mysqli_num_rows($check_destinasi) > 0) {
        	    echo '<script>alert("Lokasi ini pernah ditambahkan sebelumnya, ayo tunggu sampai admin konfirmasi lokasi kamu ya!");window.location.href="'.$cf['url'].'customer/destinasi_lain_input";</script>';
        	} else {
        	    $insert = mysqli_query($op, "INSERT INTO destinasi_lain_input (id_user,destinasi1,destinasi2) VALUES ('".$data_user['id']."','$post_destinasi1','$post_destinasi2')");
    	    if ($insert == TRUE) {
        	    echo '<script>alert("Lokasi berhasil ditambahkan, tunggu sampai admin konfirmasi lokasi kamu ya!");window.location.href="'.$cf['url'].'customer/destinasi_lain_input";</script>';
        	} else {
    		    echo "<script>alert('Gagal sistem.')</script>";
    		}
            }
        }
        ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambahkan Destinasi</h5>
              <form method="POST">
                <label for="destinasi1" class="col-sm-12 col-form-label">Masukkan Lokasi Berangkat</label>
                <input id="destinasi1" name="destinasi1" type="text" class="form-control" required>
                <small>*Alamat Lengkap</small>
                <br>
                <label for="destinasi2" class="col-sm-12 col-form-label">Masukkan Lokasi Tujuan</label>
                <input id="destinasi2" name="destinasi2" type="text" class="form-control" required>
                <small>*Alamat Lengkap</small>
                <br><br>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <a href="<? echo $cf['url']; ?>" class="btn btn-danger">Kembali</a>
                    <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                  </div>
                </div>
              </form>

            </div>
          </div>

        </div>
</div>
</main>

<? include '../library/footer.php'; ?>