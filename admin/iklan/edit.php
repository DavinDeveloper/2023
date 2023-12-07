<?
$pl = 'Admin';
$ps = TRUE;
include '../../library/configuration.php';
$check_iklan = mysqli_query($op, "SELECT * FROM iklan WHERE id = '".$_GET['1']."' AND status = 'show'");
if (mysqli_num_rows($check_iklan) == 0) {
    header("Location: ".$cf['url']."admin/iklan");
} else {
    $data_iklan = mysqli_fetch_assoc($check_iklan);
}
include '../../library/header.php';
?>

<main id="main" class="main">
<div class="row">
        <div class="col-lg-12">
        <?
        if (isset($_POST['edit'])) {
        	$post_judul = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['judul'],ENT_QUOTES)))));
        	$post_mulai = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['mulai'],ENT_QUOTES)))));
        	$post_selesai = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['selesai'],ENT_QUOTES)))));
        	$file = $_FILES['file']['name'];
        	if ($post_mulai > $post_selesai) {
        	    echo "<script>alert('Mulai tampil harus lebih awal dari selesai tampil.')</script>";
        	} else {
        	    if (!empty($file)) {
            		$x = explode('.', $file);
            		$ekstensi = strtolower(end($x));
            		$size = $_FILES['file']['size'];
            		$file_tmp = $_FILES['file']['tmp_name'];
            		$upload = str_replace(":","-",$post_mulai)."-davin-wardana-".random(10).".".$ekstensi;
            		$result = $cf['url']."assets/images/iklan/".$upload;
            		move_uploaded_file($file_tmp, '../../assets/images/iklan/'.$upload);
        	        mysqli_query($op, "UPDATE iklan SET gambar = '$result' WHERE id = '".$_GET['1']."'");
            	}
        	    $update = mysqli_query($op, "UPDATE iklan SET judul = '$post_judul', mulai = '$post_mulai', selesai = '$post_selesai' WHERE id = '".$_GET['1']."'");
        	    if ($update == TRUE) {
        	        $result = "Iklan berhasil diubah.";
        		} else {
        		    echo "<script>alert('Gagal sistem.')</script>";
                }
        	}
        }
        ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Iklan</h5>
              <? if (!empty($result)) { ?>
              <div class="alert alert-primary alert-dismissible fade show" role="alert">
              <? echo $result; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <? } ?>
              <form method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="judul" class="col-sm-12 col-form-label">Judul</label>
                  <div class="col-sm-12">
                    <input type="text" name="judul" id="judul" class="form-control" value="<? echo $data_iklan['judul']; ?>" required>
                  </div>
                </div>
                <img height="200" src="<? echo $data_iklan['gambar']; ?>">
                <div class="row mb-3">
                  <label for="file" class="col-sm-12 col-form-label">Gambar (isi jika ingin ganti) (1000x600)</label>
                  <div class="col-sm-12">
                    <input class="form-control" type="file" name="file" id="file">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="mulai" class="col-sm-12 col-form-label">Mulai Tampil</label>
                  <div class="col-sm-12">
                    <input type="date" name="mulai" id="mulai" class="form-control" value="<? echo $data_iklan['mulai']; ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="selesai" class="col-sm-12 col-form-label">Selesai Tampil</label>
                  <div class="col-sm-12">
                    <input type="date" name="selesai" id="selesai" class="form-control" value="<? echo $data_iklan['selesai']; ?>" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-10">
                    <a href="<? echo $cf['url']; ?>admin/iklan" class="btn btn-danger">Kembali</a>
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