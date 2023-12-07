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
        	$post_nama = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['nama'],ENT_QUOTES)))));
        	$check_restoran = mysqli_query($op, "SELECT * FROM restoran_input WHERE nama = '$post_nama' AND status = 'show'");
        	$data_restoran = mysqli_fetch_assoc($check_restoran);
        	if (mysqli_num_rows($check_restoran) > 0) {
        	    echo '<script>alert("Restoran ini pernah ditambahkan sebelumnya, ayo tunggu sampai admin konfirmasi restorannya ya!");window.location.href="'.$cf['url'].'customer/destinasi_restoran_input";</script>';
        	} else {
        	    $insert = mysqli_query($op, "INSERT INTO restoran_input (id_user,nama) VALUES ('".$data_user['id']."','$post_nama')");
    	    if ($insert == TRUE) {
        	    echo '<script>alert("Restoran berhasil ditambahkan, tunggu sampai admin konfirmasi restorannya ya!");window.location.href="'.$cf['url'].'customer/destinasi_restoran_input";</script>';
        	} else {
    		    echo "<script>alert('Gagal sistem.')</script>";
    		}
            }
        }
        ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambahkan Restoran</h5>
              <form method="POST">
                <label for="nama" class="col-sm-12 col-form-label">Masukkan Nama Restoran</label>
                <input id="nama" name="nama" type="text" class="form-control" required>
                <small>*Contoh: Mie Gacoan Cibiru</small>
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