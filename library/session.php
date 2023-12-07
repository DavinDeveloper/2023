<?
session_start();
if (isset($_SESSION['user'])) {
	$sess_id = $_SESSION['user']['id'];
	$check_user = mysqli_query($op, "SELECT * FROM users WHERE id = '$sess_id'");
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cf['url']."auth/keluar");
	} else {
        $data_user = mysqli_fetch_assoc($check_user);
        if ($data_user['status'] == 'Suspend') {
            echo '<script>alert("Akun anda telah dinonaktifkan.");window.location.href="'.$cf['url'].'auth/keluar";</script>';
	    } else if ($data_user['verifikasi'] !== NULL AND $pt != TRUE) {
            header("Location: ".$cf['url']."auth/verifikasi");
        } else if (($pl == 'Admin' AND $data_user['level'] != 'Admin') OR ($pl == 'Driver' AND $data_user['level'] != 'Driver') OR ($pl == 'Developer' AND $data_user['level'] != 'Developer') OR ($pl == 'Customer' AND $data_user['level'] != 'Customer')) {
            if ($data_user['level'] == 'Customer') {
                header("Location: ".$cf['url']);
            } else if ($data_user['level'] == 'Driver') {
                header("Location: ".$cf['url']."driver");
            } else if ($data_user['level'] == 'Admin') {
                header("Location: ".$cf['url']."admin");
            } else if ($data_user['level'] == 'Developer') {
                header("Location: ".$cf['url']."developer");
            }
        }
	}
} else if (!isset($_SESSION['user']) AND $ps == TRUE) {
    header("Location: ".$cf['url']."auth/masuk");
}