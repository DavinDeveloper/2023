<?
$pl = 'Customer';
$ps = TRUE;
include '../library/configuration.php';
$css .= '
<link href="https://cdn.jsdelivr.net/npm/select2/dist/css/select2.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">';
if (empty($_POST['latitude']) OR empty($_POST['longitude'])) {
    echo '<script>alert("Harap aktifkan lokasi anda.");window.location.href="'.$cf['url'].'";</script>';
}
include '../library/header.php';
?>

<main id="main" class="main">
<div class="row">
        <div class="col-lg-12">
        <?
        if (isset($_POST['pesan'])) {
        	$post_destinasi = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['destinasi'],ENT_QUOTES)))));
        	$post_catatan = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['catatan'],ENT_QUOTES)))));
        	$post_patokan = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['patokan'],ENT_QUOTES)))));
        	$post_pembayaran = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['pembayaran'],ENT_QUOTES)))));
        	$post_latitude = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['latitude'],ENT_QUOTES)))));
        	$post_longitude = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['longitude'],ENT_QUOTES)))));
        	$post_pemberangkatan = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['pemberangkatan'],ENT_QUOTES)))));
        	$check_pesanan = mysqli_query($op, "SELECT * FROM pesanan WHERE id_user = '".$data_user['id']."' AND (status != 'Selesai' AND status != 'Dibatalkan' AND status != 'Sibuk')");
        	$check_destinasi = mysqli_query($op, "SELECT * FROM destinasi_lain WHERE id = '$post_destinasi'");
        	$data_destinasi = mysqli_fetch_assoc($check_destinasi);
        	$check_customer = mysqli_query($op, "SELECT * FROM users WHERE id = '".$data_user['id']."' AND pesanan IS NOT NULL");
        	if (mysqli_num_rows($check_pesanan) > 0 OR mysqli_num_rows($check_customer) > 0) {
        	    echo '<script>alert("Masih ada pesanan yang belum selesai.");window.location.href="'.$cf['url'].'";</script>';
        	} else {
        	    $insert = mysqli_query($op, "INSERT INTO pesanan (id_user,id_destinasi_lain,pemberangkatan,tipe,catatan,patokan,harga,pembayaran,latitude_customer,longitude_customer) VALUES ('".$data_user['id']."','$post_destinasi','$post_pemberangkatan','Destinasi Lain','$post_catatan','$post_patokan','".$data_destinasi['harga']."','$post_pembayaran','$post_latitude','$post_longitude')");
            	if ($insert == TRUE) {
            	$update = mysqli_query($op, "UPDATE users SET pesanan = '".mysqli_insert_id($op)."' WHERE id = '".$data_user['id']."'");
            	}
    	    if ($update == TRUE) {
        		header("Location : ".$cf['url']);
    		} else {
    		    echo "<script>alert('Gagal sistem.')</script>";
    		}
            }
        }
        ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Destinasi Lain</h5>
              <form method="POST">
                <input type="hidden" name="latitude" value="<? echo $_POST['latitude']; ?>">
                <input type="hidden" name="longitude" value="<? echo $_POST['longitude']; ?>">
                <small>Lokasi anda sekarang</small>
                <iframe loading="lazy" width="100%" height="200" frameborder="0" style="border:0" src="https://maps.google.com/maps?q=<? echo $_POST['latitude']; ?>,<? echo $_POST['longitude']; ?>&z=14&amp;output=embed" allowfullscreen></iframe>
                <div class="row mb-3">
                <label for="destinasi" class="col-sm-12 col-form-label">Pilih Perjalanan</label>
                <select id="destinasi" name="destinasi" class="form-control select2 form-select" required>
                    <option value="">Pilih salah satu...</option>
                    <? $check_destinasi = mysqli_query($op, "SELECT * FROM destinasi_lain WHERE status = 'show' ORDER BY destinasi1 ASC");
                    while($data_destinasi = mysqli_fetch_assoc($check_destinasi)) { ?>
                    <option value="<? echo $data_destinasi['id']; ?>"><? echo $data_destinasi['destinasi1']; ?> - <? echo $data_destinasi['destinasi2']; ?> - Rp<? echo number_format($data_destinasi['harga'],0,',','.'); ?></option>
                    <? } ?>
                </select><br>
                </div>
                <small>Tidak menemukan lokasi anda? <a href="<? echo $cf['url']; ?>customer/destinasi_lain_input">Tambahkan sekarang!</a></small>
                <div id="note"></div>
                <label for="catatan" class="col-sm-12 col-form-label">Catatan </label>
                <textarea type="text" name="catatan" class="form-control"></textarea>
                <label for="patokan" class="col-sm-12 col-form-label">Patokan </label>
                <textarea type="text" name="patokan" class="form-control" required></textarea>
                <label for="pembayaran" class="col-sm-12 col-form-label">Pembayaran </label>
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input type="radio" id="pembayaran" name="pembayaran" value="Cash" class="form-check-input" required>
                        <span class="form-check-label">Cash</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" id="pembayaran" name="pembayaran" value="Cashless" class="form-check-input" required>
                        <span class="form-check-label">Cashless</span>
                    </label>
                </div><br>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" name="pesan" class="btn btn-primary">Pesan</button>
                  </div>
                </div>
              </form>

            </div>
          </div>

        </div>
</div>
</main>

<? 
$js .= '
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2/dist/js/select2.min.js"></script>
  <script>
  $(document).ready(function() {
    $(".select2").select2();
  $("#destinasi").change(function() {
  	var destinasi = $("#destinasi").val();
  	$.ajax({
  		url: "destinasi_lain_note.php",
  			data: "destinasi=" + destinasi,
  		type: "POST",
  		dataType: "html",
  		success: function(msg) {
  			$("#note").html(msg);
  		}
  	    });
    });
});
</script>';
include '../library/footer.php'; ?>