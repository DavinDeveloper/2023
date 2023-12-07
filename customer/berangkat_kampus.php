<?
include '../library/configuration.php';

if (isset($_POST['kampus']) && !empty($_POST['kampus'])) {
    $selected_kampus = $_POST['kampus'];
    $check_destinasi = mysqli_query($op, "SELECT * FROM destinasi_kampus WHERE status = 'show' ORDER BY destinasi ASC");
    ob_start();
?>
<option value="">Pilih salah satu...</option>
<?
    while ($data_destinasi = mysqli_fetch_assoc($check_destinasi)) {
?>
        <option value="<?php echo $data_destinasi['id']; ?>"><?php echo $data_destinasi['destinasi'] . ' - Rp' . number_format($data_destinasi['harga'.$selected_kampus.''], 0, ',', '.'); ?></option>
<? } 
$options = ob_get_clean();
echo $options;
} ?>