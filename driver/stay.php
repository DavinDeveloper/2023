<?
include '../library/configuration.php';
$check_driver = mysqli_query($op, "SELECT * FROM users WHERE level = 'Driver' AND stay = 'On' AND status = 'Active' AND pesanan IS NULL");
$driverStay = mysqli_num_rows($check_driver);
echo $driverStay;