<?
include '../library/configuration.php';

if (isset($_POST['destinasi']) AND !empty($_POST['destinasi'])) { 
$check_destinasi = mysqli_query($op, "SELECT * FROM destinasi_kampus WHERE id = '".$_POST['destinasi']."'");
if (mysqli_num_rows($check_destinasi) > 0) {
    $data_destinasi = mysqli_fetch_assoc($check_destinasi);
?>

<div class="alert alert-primary alert-dismissible fade show" role="alert">
  <h4 class="alert-heading"><? echo $data_destinasi['destinasi']; ?></h4>
  <p>Rp<? echo number_format($data_destinasi['harga'.$_POST['kampus'].''],0,',','.'); ?></p>
  <hr>
  <p class="mb-0">Harga di atas adalah harga berangkat kampus dari <? echo $data_destinasi['destinasi']; ?> ke Kampus <? echo $_POST['kampus']; ?>.</p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>	
<? } }