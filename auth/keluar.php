<?
session_start();
include '../library/configuration.php';
$cookie = $_COOKIE['first'].$_COOKIE['second'];
mysqli_query($op, "UPDATE users SET cookie = '' WHERE cookie = '$cookie'");
session_unset();
session_destroy();
setcookie('first', null, time()-$until+$until, "/");
setcookie('second', null, time()-$until+$until, "/");
header("Location: ".$cf['url']);