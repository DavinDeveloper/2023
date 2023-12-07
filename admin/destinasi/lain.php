<?
$pl = 'Admin';
$ps = TRUE;
$css .= '
<link href="'.$cf['url'].'assets/vendor/simple-datatables/style.css" rel="stylesheet">';
include '../../library/configuration.php'; 
        if (isset($_POST['tambah'])) {
        	$post_destinasi1 = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['destinasi1'],ENT_QUOTES)))));
        	$post_destinasi2 = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['destinasi2'],ENT_QUOTES)))));
        	$post_harga = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['harga'],ENT_QUOTES)))));
        	$check_destinasi = mysqli_query($op, "SELECT * FROM destinasi_lain WHERE ((destinasi1 = '$post_destinasi1' AND destinasi2 = '$post_destinasi2') OR (destinasi1 = '$post_destinasi2' AND destinasi2 = '$post_destinasi1')) AND status = 'show'");
        	if (mysqli_num_rows($check_destinasi) > 0) {
        	    echo "<script>alert('Destinasi tersebut sudah ada.')</script>";
        	} else {
        	    $insert = mysqli_query($op, "INSERT INTO destinasi_lain (destinasi1, destinasi2, harga, added) VALUES ('$post_destinasi1', '$post_destinasi2', '$post_harga', '".$data_user['id']."')");
        	    if ($insert == TRUE) {
        	        $result = "Destinasi <b>".$post_destinasi1." - ".$post_destinasi2."</b> telah ditambahkan.";
        		} else {
        		    echo "<script>alert('Gagal sistem.')</script>";
                }
        	}
        }
include '../../library/header.php';
?>
<main id="main" class="main">
    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
        <? if (!empty($result)) { ?>
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <? echo $result; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <? } 
        $check_destinasi_input = mysqli_query($op, "SELECT * FROM destinasi_lain_input WHERE status = 'show' ORDER BY id DESC"); 
        if (mysqli_num_rows($check_destinasi_input) > 0) { ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Destinasi Lain Input</h5>
              <p>Konfirmasi destinasi masukan dari customer.</p>
              <!-- Table with stripped rows -->
              <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Destinasi 1</th>
                    <th scope="col">Destinasi 2</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <? 
                $no = 1;
                if (isset($_POST['delete'])) {
                    mysqli_query($op, "UPDATE destinasi_lain_input SET status = 'hide' WHERE id = '".$_POST['id']."'");
                    header("Location: ".$cf['url']."admin/destinasi/lain");
                }
                while($data_destinasi_input = mysqli_fetch_assoc($check_destinasi_input)) {?>
                  <tr>
                    <th scope="row"><? echo $no++; ?></th>
                    <td><? echo $data_destinasi_input['destinasi1']; ?></td>
                    <td><? echo $data_destinasi_input['destinasi2']; ?></td>
                    <td>
                    <form method="POST">
                    <input name="id" value="<? echo $data_destinasi_input['id']; ?>" hidden>
                    <button type="submit" name="delete" class="btn btn-danger"><i class="bi bi-x-circle"></i></button>
                    </form>
                    <a href="<? echo $cf['url']; ?>admin/destinasi/edit-lain-input?1=<? echo $data_destinasi_input['id']; ?>" class="btn btn-success"><i class="bi bi-check-circle"></i></a>
                    </td>
                  </tr>
                <? } ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
             </div>
            </div>
          </div>
          <? } ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Destinasi Lain</h5>
              <p>Tambahkan dan edit destinasi dibawah.</p>
              <!--<div align="right" class="text-right float-right">-->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
              <!--</div>-->
                  <div class="modal fade" id="tambah" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Tambah Destinasi</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="card">
                        <div class="card-body">
                        <form method="POST">
                        <div class="row mb-3">
                          <label for="destinasi1" class="col-sm-12 col-form-label">Destinasi 1</label>
                          <div class="col-sm-12">
                            <input type="text" name="destinasi1" id="destinasi1" class="form-control" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="destinasi2" class="col-sm-12 col-form-label">Destinasi 2</label>
                          <div class="col-sm-12">
                            <input type="text" name="destinasi2" id="destinasi2" class="form-control" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="harga" class="col-sm-12 col-form-label">Harga</label>
                          <div class="col-sm-12">
                            <input type="number" name="harga" id="harga" class="form-control" required>
                          </div>
                        </div>
                        </div></div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" name="tambah" class="btn btn-primary">Tambahkan</button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
              <!-- Table with stripped rows -->
              <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Destinasi 1</th>
                    <th scope="col">Destinasi 2</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <? 
                $no = 1;
                if (isset($_POST['delete'])) {
                    mysqli_query($op, "UPDATE destinasi_lain SET status = 'hide', deleted = '".$data_user['id']."' WHERE id = '".$_POST['id']."'");
                    header("Location: ".$cf['url']."admin/destinasi/lain");
                }
                $check_destinasi = mysqli_query($op, "SELECT * FROM destinasi_lain WHERE status = 'show' ORDER BY destinasi1 ASC"); 
                while($data_destinasi = mysqli_fetch_assoc($check_destinasi)) {?>
                  <tr>
                    <th scope="row"><? echo $no++; ?></th>
                    <td><? echo $data_destinasi['destinasi1']; ?></td>
                    <td><? echo $data_destinasi['destinasi2']; ?></td>
                    <td>Rp<? echo number_format($data_destinasi['harga'],0,',','.'); ?></td>
                    <td><a href="<? echo $cf['url']; ?>admin/destinasi/edit-lain?1=<? echo $data_destinasi['id']; ?>" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                    <form method="POST">
                    <input name="id" value="<? echo $data_destinasi['id']; ?>" hidden>
                    <button type="submit" name="delete" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                    </td>
                  </tr>
                <? } ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
             </div>
            </div>
          </div>

        </div>
      </div>
    </section>
    
</main>

<? 
$js .= '
<script src="'.$cf['url'].'assets/vendor/simple-datatables/simple-datatables.js"></script>';
include '../../library/footer.php'; ?>