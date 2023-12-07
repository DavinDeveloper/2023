<?
$pl = 'Admin';
$ps = TRUE;
include '../../library/configuration.php';
$check_restoran = mysqli_query($op, "SELECT * FROM restoran WHERE id = '".$_GET['1']."' AND status = 'show'");
if (mysqli_num_rows($check_restoran) == 0) {
    header("Location: ".$cf['url']."admin/restoran");
} else {
    $data_restoran = mysqli_fetch_assoc($check_restoran);
}
include '../../library/header.php';
?>

<main id="main" class="main">
<div class="row">
        <div class="col-lg-12">
        <?
        if (isset($_POST['edit'])) {
        	$post_nama = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['nama'],ENT_QUOTES)))));
        	$post_lokasi = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['lokasi'],ENT_QUOTES)))));
        	$post_menu = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['menu'],ENT_QUOTES)))));
        	    $update = mysqli_query($op, "UPDATE restoran SET nama = '$post_nama', lokasi = '$post_lokasi', menu = '$post_menu' WHERE id = '".$_GET['1']."'");
        	    if ($update == TRUE) {
        	        $result = "Restoran berhasil diubah.";
        		} else {
        		    echo "<script>alert('Gagal sistem.')</script>";
                }
        	}
        ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Restoran</h5>
              <? if (!empty($result)) { ?>
              <div class="alert alert-primary alert-dismissible fade show" role="alert">
              <? echo $result; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <? } ?>
              <form method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="nama" class="col-sm-12 col-form-label">Nama Restoran</label>
                  <div class="col-sm-12">
                    <input type="text" name="nama" id="nama" class="form-control" value="<? echo $data_restoran['nama']; ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="lokasi" class="col-sm-12 col-form-label">Lokasi Restoran</label>
                  <div class="col-sm-12">
                    <textarea type="text" name="lokasi" id="lokasi" class="form-control" required><? echo $data_restoran['lokasi']; ?></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="menu" class="col-sm-12 col-form-label">Menu Restoran</label>
                  <div class="col-sm-12">
                    <textarea type="text" name="menu" id="menu" class="form-control" required><? echo $data_restoran['menu']; ?></textarea>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-10">
                    <a href="<? echo $cf['url']; ?>admin/restoran" class="btn btn-danger">Kembali</a>
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