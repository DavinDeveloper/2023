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
        	$post_destinasi = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['destinasi'],ENT_QUOTES)))));
        	$check_destinasi = mysqli_query($op, "SELECT * FROM destinasi_kampus_input WHERE destinasi = '$post_destinasi' AND status = 'show'");
        	$data_destinasi = mysqli_fetch_assoc($check_destinasi);
        	if (mysqli_num_rows($check_destinasi) > 0) {
        	    echo '<script>alert("Lokasi ini pernah ditambahkan sebelumnya, ayo tunggu sampai admin konfirmasi lokasi kamu ya!");window.location.href="'.$cf['url'].'customer/destinasi_kampus_input";</script>';
        	} else {
        	    $insert = mysqli_query($op, "INSERT INTO destinasi_kampus_input (id_user,destinasi) VALUES ('".$data_user['id']."','$post_destinasi')");
    	    if ($insert == TRUE) {
        	    echo '<script>alert("Lokasi berhasil ditambahkan, tunggu sampai admin konfirmasi lokasi kamu ya!");window.location.href="'.$cf['url'].'customer/destinasi_kampus_input";</script>';
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
                <label for="destinasi" class="col-sm-12 col-form-label">Masukkan Lokasi Anda</label>
                <input id="destinasi" name="destinasi" type="text" class="form-control" required>
                <small>*Alamat lengkap : Nama Kost(Opsional), Nama Jalan, Kelurahan, Kecamatan, Kota/Kabupaten Bandung <? if (!empty($_GET['1'])) { ?>(Nama Resto Yang Diinginkan)<? } ?>
<br>Contoh : Kost Zaffirt House, Jalan Manisi, Pasirbiru, Cibiru, Kota Bandung <? if (!empty($_GET['1'])) { ?>(Alibaba Fried Chicken)<? } ?></small>
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