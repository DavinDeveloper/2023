<?
include '../library/configuration.php';
$check_pesanan = mysqli_query($op, "SELECT * FROM pesanan WHERE id = '".$_GET['1']."'");
$data_pesanan = mysqli_fetch_assoc($check_pesanan);
$status = $data_pesanan['status'];
echo $status;