<?
$pl = 'Admin';
$ps = TRUE;
include '../../library/configuration.php';
$check_customer = mysqli_query($op, "SELECT * FROM users WHERE id = '".$_GET['1']."'");
if (mysqli_num_rows($check_customer) == 0) {
    header("Location: ".$cf['url']."admin/customer");
} else {
    $data_customer = mysqli_fetch_assoc($check_customer);
}
include '../../library/header.php';
?>

<main id="main" class="main">
<div class="row">
        <div class="col-lg-12">
        <?
        if (isset($_POST['edit'])) {
        	$post_email = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['email'],ENT_QUOTES)))));
        	$post_telepon = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['telepon'],ENT_QUOTES)))));
        	$post_level = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['level'],ENT_QUOTES)))));
        	$check_customer = mysqli_query($op, "SELECT * FROM users WHERE (telepon = '$post_telepon' OR email = '$post_email') AND id != '".$_GET['1']."'");
        	if (mysqli_num_rows($check_customer) > 0) {
        	    echo "<script>alert('Pengguna dengan email atau customer tersebut sudah ada.')</script>";
        	} else if ($post_level == 'Admin' OR $post_level == 'Developer') {
        	    echo "<script>alert('Hanya level customer atau driver yang diizinkan untuk diubah.')</script>";
        	} else {
        	    if ($post_level != $data_customer['level']) {
        	        mysqli_query($op, "UPDATE users SET identitas = '', upload = 'Nothing', status = 'Pending' WHERE id = '".$_GET['1']."'");
        	    }
        	    $update = mysqli_query($op, "UPDATE users SET email = '$post_email', telepon = '$post_telepon', level = '$post_level' WHERE id = '".$_GET['1']."'");
        	    if ($update == TRUE) {
        	        $result = "Akun customer berhasil diubah.";
        		} else {
        		    echo "<script>alert('Gagal sistem.')</script>";
                }
        	}
        }
        ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Akun Customer</h5>
              <? if (!empty($result)) { ?>
              <div class="alert alert-primary alert-dismissible fade show" role="alert">
              <? echo $result; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <? } ?>
              <form method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="nama" class="col-sm-12 col-form-label">Nama</label>
                  <div class="col-sm-12">
                    <input type="text" name="nama" id="nama" class="form-control" value="<? echo $data_customer['nama']; ?>" readonly>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="email" class="col-sm-12 col-form-label">Email</label>
                  <div class="col-sm-12">
                    <input type="email" name="email" id="email" class="form-control" value="<? echo $data_customer['email']; ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="telepon" class="col-sm-12 col-form-label">Telepon</label>
                  <div class="col-sm-12">
                    <input type="number" name="telepon" id="telepon" class="form-control" value="<? echo $data_customer['telepon']; ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                    <label for="level" class="col-sm-12 col-form-label">Level</label>
                    <div class="col-sm-12">
                    <select id="level" name="level" class="form-control" required>
                        <option value="Customer" <? if ($data_customer['level'] == 'Customer') { echo 'selected'; } ?>>Customer <? if ($data_customer['level'] == 'Customer') { echo '(selected)'; } ?></option>
                        <option value="Driver" <? if ($data_customer['level'] == 'Driver') { echo 'selected'; } ?>>Driver <? if ($data_customer['level'] == 'Driver') { echo '(selected)'; } ?></option>
                    </select>
                    </div><br>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <a href="<? echo $cf['url']; ?>admin/customer" class="btn btn-danger">Kembali</a>
                    <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                  </div>
                </div>

              </form>

            </div>
          </div>

        </div>
</div>
</main>

<? include '../../library/footer.php'; ?>