<?
$pl = 'Driver';
$ps = TRUE;
include '../library/configuration.php';
if ($data_user['upload'] == 'Confirmed' OR $data_user['status'] == 'Active') {
    header("Location: ".$cf['url']);
}
include '../library/header.php';
?>

<main id="main" class="main">
<div class="row">
    <? if ($data_user['upload'] == 'Nothing' OR $data_user['upload'] == 'Rejected') {  ?>
        <div class="col-lg-12">
        <?
        if (isset($_POST['upload'])) {
        	$post_nama = $op->real_escape_string(strtoupper(trim(stripslashes(strip_tags(htmlspecialchars($_POST['nama'],ENT_QUOTES))))));
        	$post_merk = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['merk'],ENT_QUOTES)))));
        	$post_warna = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['warna'],ENT_QUOTES)))));
        	$post_plat = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['plat'],ENT_QUOTES)))));
        	$file = $_FILES['file']['name'];
        	$face = $_FILES['face']['name'];
    	    if (!empty($file) AND !empty($face)) {
        		$upload = "davin-wardana-".random(10)."-".$data_user['id'].".".strtolower(end(explode('.', $file)));
        		$result = $cf['url']."assets/images/driver/ktm/".$upload;
        		move_uploaded_file($_FILES['file']['tmp_name'], '../assets/images/driver/ktm/'.$upload);
        		$upload_face = "davin-wardana-".random(10)."-".$data_user['id'].".".strtolower(end(explode('.', $face)));
        		$result_face = $cf['url']."assets/images/driver/face/".$upload_face;
        		move_uploaded_file($_FILES['face']['tmp_name'], '../assets/images/driver/face/'.$upload_face);
    	    $insert = mysqli_query($op, "INSERT INTO riwayat_upload (id_user, file, jenis) VALUES ('".$data_user['id']."', '$result', 'FACE')");
    	    $insert = mysqli_query($op, "INSERT INTO riwayat_upload (id_user, file, jenis) VALUES ('".$data_user['id']."', '$result_face', 'KTM')");
        	$update = mysqli_query($op, "UPDATE users SET identitas = '$result', nama = '$post_nama', upload = 'Pending', driver_merk = '$post_merk', driver_warna = '$post_warna', driver_plat = '$post_plat', driver_face = '$result_face' WHERE id = '".$data_user['id']."'");
        	}
    	    if ($insert == TRUE) {
        		header("Location : ".$cf['url']);
    		} else {
    		    echo "<script>alert('Gagal sistem.')</script>";
            }
        }
        ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Upload Data Driver</h5>
              <form method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="nama" class="col-sm-12 col-form-label">Nama Lengkap (Sesuai KTM)</label>
                  <div class="col-sm-12">
                    <input type="text" name="nama" id="nama" class="form-control" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="file" class="col-sm-12 col-form-label">Upload KTM</label>
                  <div class="col-sm-12">
                    <input class="form-control" type="file" name="file" id="file" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="merk" class="col-sm-12 col-form-label">Merk Kendaraan</label>
                  <div class="col-sm-12">
                    <input type="text" name="merk" id="merk" class="form-control" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="warna" class="col-sm-12 col-form-label">Warna Kendaraan</label>
                  <div class="col-sm-12">
                    <input type="text" name="warna" id="warna" class="form-control" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="plat" class="col-sm-12 col-form-label">Plat Nomor</label>
                  <div class="col-sm-12">
                    <input type="text" name="plat" id="plat" class="form-control" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="file" class="col-sm-12 col-form-label">Upload Foto Wajah</label>
                  <div class="col-sm-12">
                    <input class="form-control" type="file" name="face" id="face" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" name="upload" class="btn btn-primary">Upload</button>
                  </div>
                </div>

              </form>

            </div>
          </div>

        </div>
    <? } else if ($data_user['upload'] == 'Pending' OR $data_user['status'] == 'Pending') { ?>
    <section class="section profile">
      <div class="row">
        <div class="col-xl-12">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<? echo $data_user['identitas']; ?>" alt="Identitas">
              <img src="<? echo $data_user['driver_face']; ?>" alt="Face">
              <h2><? echo $data_user['nama']; ?></h2>
              <h3><? echo $data_user['level']; ?></h3>
              <p>Akun anda sedang diverifikasi oleh admin, tunggu sampai pemeriksaan selesai, kami akan memberitahu jika sudah.</p>
            </div>
          </div>

        </div>
      </div>
    </section>
    <? } ?>
</div>
</main>

<? include '../library/footer.php'; ?>