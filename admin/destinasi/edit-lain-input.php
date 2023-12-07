<?
$pl = 'Admin';
$ps = TRUE;
include '../../library/configuration.php';
$check_destinasi = mysqli_query($op, "SELECT * FROM destinasi_lain_input WHERE id = '".$_GET['1']."' AND status = 'show'");
if (mysqli_num_rows($check_destinasi) == 0) {
    header("Location: ".$cf['url']."admin/destinasi/lain");
} else {
    $data_destinasi = mysqli_fetch_assoc($check_destinasi);
}
    
include '../../library/header.php';
?>

<main id="main" class="main">
<div class="row">
        <div class="col-lg-12">
        <?
        if (isset($_POST['tambah'])) {
        	$post_destinasi1 = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['destinasi1'],ENT_QUOTES)))));
        	$post_destinasi2 = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['destinasi2'],ENT_QUOTES)))));
        	$post_harga = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['harga'],ENT_QUOTES)))));
        	$check_destinasi = mysqli_query($op, "SELECT * FROM destinasi_lain WHERE ((destinasi1 = '$post_destinasi1' AND destinasi2 = '$post_destinasi2') OR (destinasi1 = '$post_destinasi2' AND destinasi2 = '$post_destinasi1')) AND status = 'show'");
        	if (mysqli_num_rows($check_destinasi) > 0) {
        	    echo "<script>alert('Destinasi tersebut sudah ada.')</script>";
        	} else {
        	$data_customer = mysqli_fetch_assoc(mysqli_query($op, "SELECT telepon FROM users WHERE id = '".$data_destinasi['id_user']."'"));
            whatsapp($data_customer['telepon'], 'Lokasi kamu sudah dikonfirmasi sama admin, yuk gunakan '.$cf['name'].' sekarang.');
        	$update = mysqli_query($op, "UPDATE destinasi_lain_input SET destinasi1 = '$post_destinasi1', destinasi2 = '$post_destinasi2', harga = '$post_harga', status = 'hide' WHERE id = '".$_GET['1']."'");
        	$insert = mysqli_query($op, "INSERT INTO destinasi_lain (destinasi1, destinasi2, harga, added) VALUES ('$post_destinasi1', '$post_destinasi2', '$post_harga', '".$data_user['id']."')");
            	if ($insert == TRUE) {
                    echo '<script>alert("Destinasi berhasil ditambahkan.");window.location.href="'.$cf['url'].'admin/destinasi/lain";</script>';
            	} else {
            	    echo "<script>alert('Gagal sistem.')</script>";
                }
        	}
        }
        ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Konfirmasi Destinasi Lain</h5>
              <form method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="destinasi1" class="col-sm-12 col-form-label">Destinasi 1</label>
                  <div class="col-sm-12">
                    <input type="text" name="destinasi1" id="destinasi1" class="form-control" value="<? echo $data_destinasi['destinasi1']; ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="destinasi2" class="col-sm-12 col-form-label">Destinasi 2</label>
                  <div class="col-sm-12">
                    <input type="text" name="destinasi2" id="destinasi2" class="form-control" value="<? echo $data_destinasi['destinasi2']; ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="harga" class="col-sm-12 col-form-label">Setel Harga</label>
                  <div class="col-sm-12">
                    <input type="number" name="harga" id="harga" class="form-control" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-10">
                    <a href="<? echo $cf['url']; ?>admin/destinasi/lain" class="btn btn-danger">Kembali</a>
                    <button type="submit" name="tambah" class="btn btn-success">Tambah</button>
                  </div>
                </div>

              </form>

            </div>
          </div>

        </div>
</div>
</main>

<? include '../../library/footer.php'; ?>