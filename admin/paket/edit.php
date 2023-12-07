<?
$pl = 'Admin';
$ps = TRUE;
include '../../library/configuration.php';
$check_kategori = mysqli_query($op, "SELECT * FROM kategori_paket WHERE id = '".$_GET['1']."' AND status = 'show'");
if (mysqli_num_rows($check_kategori) == 0) {
    header("Location: ".$cf['url']."admin/paket");
} else {
    $data_kategori = mysqli_fetch_assoc($check_kategori);
}
include '../../library/header.php';
?>

<main id="main" class="main">
<div class="row">
        <div class="col-lg-12">
        <?
        if (isset($_POST['edit'])) {
        	$post_nama = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['nama'],ENT_QUOTES)))));
        	    $update = mysqli_query($op, "UPDATE kategori_paket SET nama = '$post_nama' WHERE id = '".$_GET['1']."'");
        	    if ($update == TRUE) {
        	        $result = "Kategori paket berhasil diubah.";
        		} else {
        		    echo "<script>alert('Gagal sistem.')</script>";
                }
        	}
        ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Kategori Paket</h5>
              <? if (!empty($result)) { ?>
              <div class="alert alert-primary alert-dismissible fade show" role="alert">
              <? echo $result; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <? } ?>
              <form method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="nama" class="col-sm-12 col-form-label">Nama Kategori</label>
                  <div class="col-sm-12">
                    <input type="text" name="nama" id="nama" class="form-control" value="<? echo $data_kategori['nama']; ?>" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-10">
                    <a href="<? echo $cf['url']; ?>admin/paket" class="btn btn-danger">Kembali</a>
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