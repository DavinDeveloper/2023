<?
include '../library/configuration.php';
if ($_SESSION['chat'] == TRUE) {
    unset($_SESSION['chat']);
    echo '<script>alert("Live chat dinonaktifkan.");window.location.href="'.$cf['url'].'";</script>';
} else {
    $_SESSION['chat'] = TRUE;
    echo '<script>alert("Live chat diaktifkan.");window.location.href="'.$cf['url'].'";</script>';
}