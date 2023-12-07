<?
include '../library/configuration.php';

if (isset($_POST['destinasi']) AND !empty($_POST['destinasi'])) { 
$check_destinasi_restoran = mysqli_query($op, "SELECT * FROM destinasi_restoran WHERE id = '".$_POST['destinasi']."'");
if (mysqli_num_rows($check_destinasi_restoran) > 0) {
    $data_destinasi_restoran = mysqli_fetch_assoc($check_destinasi_restoran);
    $data_destinasi = mysqli_fetch_assoc(mysqli_query($op, "SELECT * FROM destinasi_kampus WHERE id = '".$data_destinasi_restoran['id_destinasi']."'"));
    $data_restoran = mysqli_fetch_assoc(mysqli_query($op, "SELECT * FROM restoran WHERE id = '".$data_destinasi_restoran['id_restoran']."'"));
?>

<div class="alert alert-primary alert-dismissible fade show" role="alert">
  <h4 class="alert-heading"><? echo $data_destinasi['destinasi']; ?></h4>
  <p>Rp<? echo number_format($data_destinasi_restoran['harga'],0,',','.'); ?></p>
  <hr>
  <p class="mb-0">Harga di atas adalah harga pengantaran makanan dari resto <? echo $data_restoran['nama']; ?> ke <? echo $data_destinasi['destinasi']; ?>. Harga total setelah makanan dipesan akan diupdate setelah driver memesan makanan ke resto.</p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>	
<? } }