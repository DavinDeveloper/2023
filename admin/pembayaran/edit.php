<?
$pl = 'Admin';
$ps = TRUE;
include '../../library/configuration.php';
$check_pembayaran = mysqli_query($op, "SELECT * FROM metode_pembayaran WHERE id = '".$_GET['1']."' AND status = 'show'");
if (mysqli_num_rows($check_pembayaran) == 0) {
    header("Location: ".$cf['url']."admin/pembayaran");
} else {
    $data_pembayaran = mysqli_fetch_assoc($check_pembayaran);
}
include '../../library/header.php';
?>

<main id="main" class="main">
<div class="row">
        <div class="col-lg-12">
        <?
        if (isset($_POST['edit'])) {
        	$post_nomor = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['nomor'],ENT_QUOTES)))));
        	$post_alias = $op->real_escape_string(strtoupper(trim(stripslashes(strip_tags(htmlspecialchars($_POST['alias'],ENT_QUOTES))))));
        	$file = $_FILES['file']['name'];
        	    if (!empty($file)) {
            		$x = explode('.', $file);
            		$ekstensi = strtolower(end($x));
            		$size = $_FILES['file']['size'];
            		$file_tmp = $_FILES['file']['tmp_name'];
            	    $upload = str_replace(":","-",date("H:i:s"))."-davin-wardana-".random(10).".".$ekstensi;
            		$result = $cf['url']."assets/images/pembayaran/".$upload;
            		move_uploaded_file($file_tmp, '../../assets/images/pembayaran/'.$upload);
        	        mysqli_query($op, "UPDATE metode_pembayaran SET qr = '$result' WHERE id = '".$_GET['1']."'");
            	}
        	    $update = mysqli_query($op, "UPDATE metode_pembayaran SET nomor = '$post_nomor', alias = '$post_alias' WHERE id = '".$_GET['1']."'");
        	    if ($update == TRUE) {
        	        $result = "Pembayaran berhasil diubah.";
        		} else {
        		    echo "<script>alert('Gagal sistem.')</script>";
                }
        	}
        ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Metode Pembayaran</h5>
              <? if (!empty($result)) { ?>
              <div class="alert alert-primary alert-dismissible fade show" role="alert">
              <? echo $result; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <? } ?>
              <form method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="nama" class="col-sm-12 col-form-label">Nama Bank/Wallet</label>
                  <div class="col-sm-12">
                    <input type="text" name="nama" id="nama" class="form-control" value="<? echo $data_pembayaran['nama']; ?>" readonly>
                  </div>
                </div>
                <? if (!empty($data_pembayaran['qr'])) { ?>
                <img height="200" src="<? echo $data_pembayaran['qr']; ?>">
                <div class="row mb-3">
                  <label for="file" class="col-sm-12 col-form-label">Qr (isi jika ingin ganti)</label>
                  <div class="col-sm-12">
                    <input class="form-control" type="file" name="file" id="file">
                  </div>
                </div>
                <? } else { ?>
                <div class="row mb-3">
                  <label for="nomor" class="col-sm-12 col-form-label">Nomor Rekening</label>
                  <div class="col-sm-12">
                    <input type="text" name="nomor" id="nomor" class="form-control" value="<? echo $data_pembayaran['nomor']; ?>" required>
                  </div>
                </div>
                <? } ?>
                <div class="row mb-3">
                  <label for="alias" class="col-sm-12 col-form-label">Pemilik Bank/Penerima Pembayaran</label>
                  <div class="col-sm-12">
                    <input type="text" name="alias" id="alias" class="form-control" value="<? echo $data_pembayaran['alias']; ?>" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-10">
                    <a href="<? echo $cf['url']; ?>admin/pembayaran" class="btn btn-danger">Kembali</a>
                    <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                  </div>
                </div>

              </form>

            </div>
          </div>

        </div>
</div>
</main>

<? include '../../library/footer.php'; ?>