<?
include '../library/configuration.php';

if (isset($_POST['destinasi']) AND !empty($_POST['destinasi'])) { 
$check_destinasi = mysqli_query($op, "SELECT * FROM destinasi_lain WHERE id = '".$_POST['destinasi']."'");
if (mysqli_num_rows($check_destinasi) > 0) {
    $data_destinasi = mysqli_fetch_assoc($check_destinasi);
?>

<div class="alert alert-primary alert-dismissible fade show" role="alert">
  <h4 class="alert-heading"><? echo $data_destinasi['destinasi1']; ?> - <? echo $data_destinasi['destinasi2']; ?></h4>
  <p>Rp<? echo number_format($data_destinasi['harga'],0,',','.'); ?></p>
  <hr>
  <p class="mb-0">Harga di atas adalah harga perjalanan dari <? echo $data_destinasi['destinasi1']; ?> ke <? echo $data_destinasi['destinasi2']; ?> atau sebaliknya.</p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>	
<label for="pemberangkatan" class="col-sm-12 col-form-label">Pemberangkatan </label>
<div class="selectgroup w-100">
    <label class="selectgroup-item">
        <input type="radio" id="pemberangkatan" name="pemberangkatan" value="1" class="form-check-input" required>
        <span class="form-check-label"><? echo $data_destinasi['destinasi1']; ?></span>
    </label>
    <label class="selectgroup-item">
        <input type="radio" id="pemberangkatan" name="pemberangkatan" value="2" class="form-check-input" required>
        <span class="form-check-label"><? echo $data_destinasi['destinasi2']; ?></span>
    </label>
</div>
<? } }