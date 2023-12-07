<?
session_start();
date_default_timezone_set('Asia/Jakarta');
$op = mysqli_connect('localhost','u1574150_opus_beta','u1574150_opus_beta','u1574150_opus_beta');
if (mysqli_connect_error()) {
	die("Database error!");
}
$until = 1000000000;
$cf = mysqli_fetch_assoc(mysqli_query($op, "SELECT * FROM config_website WHERE id = '1'"));
$cw = mysqli_fetch_assoc(mysqli_query($op, "SELECT * FROM config_whatsapp WHERE id = '1'"));
$ce = mysqli_fetch_assoc(mysqli_query($op, "SELECT * FROM config_email WHERE id = '1'"));
$cc = mysqli_fetch_assoc(mysqli_query($op, "SELECT * FROM config_contact WHERE id = '1'"));
if ($cf['mt'] == 'On' AND $pt != TRUE) {
    header("Location: ".$cf['url']."page/503");
}
$sf = substr($cf['url'], 0, -1).str_replace("index","",str_replace(".php","",str_replace(".html","",$_SERVER['PHP_SELF'])));
include 'function.php';
include 'session.php';