<?
$pl = 'Admin';
$ps = TRUE;
include '../../library/configuration.php';
$check_destinasi = mysqli_query($op, "SELECT * FROM destinasi_kampus WHERE id = '".$_GET['1']."' AND status = 'show'");
if (mysqli_num_rows($check_destinasi) == 0) {
    header("Location: ".$cf['url']."admin/destinasi");
} else {
    $data_destinasi = mysqli_fetch_assoc($check_destinasi);
}
    
include '../../library/header.php';
?>

<main id="main" class="main">
<div class="row">
        <div class="col-lg-12">
        <?
        if (isset($_POST['edit'])) {
        	$post_harga1 = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['harga1'],ENT_QUOTES)))));
        	$post_harga2 = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['harga2'],ENT_QUOTES)))));
        	$update = mysqli_query($op, "UPDATE destinasi_kampus SET harga1 = '$post_harga1', harga2 = '$post_harga2' WHERE id = '".$_GET['1']."'");
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
                  <label for="destinasi" class="col-sm-12 col-form-label">Destinasi</label>
                  <div class="col-sm-12">
                    <input type="text" name="destinasi" id="destinasi" class="form-control" value="<? echo $data_destinasi['destinasi']; ?>" readonly>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="harga1" class="col-sm-12 col-form-label">Harga dari Kampus 1</label>
                  <div class="col-sm-12">
                    <input type="number" name="harga1" id="harga1" class="form-control" value="<? echo $data_destinasi['harga1']; ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="harga2" class="col-sm-12 col-form-label">Harga dari Kampus 2</label>
                  <div class="col-sm-12">
                    <input type="number" name="harga2" id="harga2" class="form-control" value="<? echo $data_destinasi['harga2']; ?>" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-10">
                    <a href="<? echo $cf['url']; ?>admin/destinasi" class="btn btn-danger">Kembali</a>
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