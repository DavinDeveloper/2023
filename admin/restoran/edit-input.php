<?
$pl = 'Admin';
$ps = TRUE;
include '../../library/configuration.php';
$check_restoran = mysqli_query($op, "SELECT * FROM restoran_input WHERE id = '".$_GET['1']."' AND status = 'show'");
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
        if (isset($_POST['tambah'])) {
        	$post_nama = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['nama'],ENT_QUOTES)))));
        	$post_lokasi = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['lokasi'],ENT_QUOTES)))));
        	$post_menu = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['menu'],ENT_QUOTES)))));
        	$check_restoran = mysqli_query($op, "SELECT * FROM restoran WHERE nama = '$post_nama' AND status = 'show'");
        	if (mysqli_num_rows($check_restoran) > 0) {
        	    echo "<script>alert('Nama restoran tersebut sudah ada.')</script>";
        	} else {
        	$data_customer = mysqli_fetch_assoc(mysqli_query($op, "SELECT telepon FROM users WHERE id = '".$data_restoran['id_user']."'"));
            whatsapp($data_customer['telepon'], 'Penambahan restoran kamu sudah dikonfirmasi sama admin, yuk gunakan '.$cf['name'].' sekarang.');
        	$update = mysqli_query($op, "UPDATE restoran_input SET nama = '$post_nama', status = 'hide' WHERE id = '".$_GET['1']."'");
        	$insert = mysqli_query($op, "INSERT INTO restoran (nama, lokasi, menu) VALUES ('$post_nama', '$post_lokasi', '$post_menu')");
            	if ($insert == TRUE) {
                    echo '<script>alert("Restoran berhasil ditambahkan.");window.location.href="'.$cf['url'].'admin/restoran";</script>';
            	} else {
            	    echo "<script>alert('Gagal sistem.')</script>";
                }
        	}
        }
        ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Konfirmasi Restoran</h5>
              <form method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="nama" class="col-sm-12 col-form-label">Nama Restoran</label>
                  <div class="col-sm-12">
                    <input type="text" name="nama" id="nama" class="form-control" value="<? echo $data_restoran['nama']; ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="lokasi" class="col-sm-12 col-form-label">Lokasi Restoran</label>
                  <div class="col-sm-12">
                    <textarea type="text" name="lokasi" id="lokasi" class="form-control" required></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="menu" class="col-sm-12 col-form-label">Menu Restoran</label>
                  <div class="col-sm-12">
                    <textarea type="text" name="menu" id="menu" class="form-control" rows="6" required></textarea>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-10">
                    <a href="<? echo $cf['url']; ?>admin/restoran" class="btn btn-danger">Kembali</a>
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