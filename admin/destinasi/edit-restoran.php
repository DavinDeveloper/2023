<?
$pl = 'Admin';
$ps = TRUE;
include '../../library/configuration.php';
$check_destinasi = mysqli_query($op, "SELECT * FROM destinasi_restoran WHERE id = '".$_GET['1']."' AND status = 'show'");
if (mysqli_num_rows($check_destinasi) == 0) {
    header("Location: ".$cf['url']."admin/destinasi/restoran");
} else {
    $data_destinasi = mysqli_fetch_assoc($check_destinasi);
    $data_nama = mysqli_fetch_assoc(mysqli_query($op, "SELECT destinasi FROM destinasi_kampus WHERE id = '".$data_destinasi['id_destinasi']."'"));
    $data_restoran = mysqli_fetch_assoc(mysqli_query($op, "SELECT nama FROM restoran WHERE id = '".$data_destinasi['id_restoran']."'"));
}
    
include '../../library/header.php';
?>

<main id="main" class="main">
<div class="row">
        <div class="col-lg-12">
        <?
        if (isset($_POST['edit'])) {
        	$post_harga = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['harga'],ENT_QUOTES)))));
        	$update = mysqli_query($op, "UPDATE destinasi_restoran SET harga = '$post_harga' WHERE id = '".$_GET['1']."'");
        	if ($update == TRUE) {
        	    $result = "Harga destinasi berhasil diubah.";
        	} else {
        	    echo "<script>alert('Gagal sistem.')</script>";
            }
        }
        ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Destinasi</h5>
              <? if (!empty($result)) { ?>
              <div class="alert alert-primary alert-dismissible fade show" role="alert">
              <? echo $result; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <? } ?>
              <form method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="restoran" class="col-sm-12 col-form-label">Restoran</label>
                  <div class="col-sm-12">
                    <input type="text" name="restoran" id="restoran" class="form-control" value="<? echo $data_restoran['nama']; ?>" readonly>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="destinasi" class="col-sm-12 col-form-label">Destinasi</label>
                  <div class="col-sm-12">
                    <input type="text" name="destinasi" id="destinasi" class="form-control" value="<? echo $data_nama['destinasi']; ?>" readonly>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="harga" class="col-sm-12 col-form-label">Harga</label>
                  <div class="col-sm-12">
                    <input type="number" name="harga" id="harga" class="form-control" value="<? echo $data_destinasi['harga']; ?>" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-10">
                    <a href="<? echo $cf['url']; ?>admin/destinasi/restoran" class="btn btn-danger">Kembali</a>
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