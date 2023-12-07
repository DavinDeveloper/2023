<?
include '../library/configuration.php';

if (isset($_POST['restoran']) AND !empty($_POST['restoran'])) { 
$check_restoran = mysqli_query($op, "SELECT * FROM restoran WHERE id = '".$_POST['restoran']."'");
if (mysqli_num_rows($check_restoran) > 0) {
    $data_restoran = mysqli_fetch_assoc($check_restoran);
?>

<div class="alert alert-primary alert-dismissible fade show" role="alert">
  <h4 class="alert-heading"><? echo $data_restoran['nama']; ?></h4>
  <p><? echo nl2br(str_replace(‘‘, ‘‘, htmlspecialchars($data_restoran['lokasi']))); ?></p>
  <hr>
  <p class="mb-0"><? echo nl2br(str_replace(‘‘, ‘‘, htmlspecialchars($data_restoran['menu']))); ?></p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>	
<? } }