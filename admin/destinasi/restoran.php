<?
$pl = 'Admin';
$ps = TRUE;
$css .= '
<link href="https://cdn.jsdelivr.net/npm/select2/dist/css/select2.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="'.$cf['url'].'assets/vendor/simple-datatables/style.css" rel="stylesheet">';
include '../../library/configuration.php'; 
        if (isset($_POST['tambah'])) {
        	$post_restoran = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['restoran'],ENT_QUOTES)))));
        	$post_destinasi = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['destinasi'],ENT_QUOTES)))));
        	$post_harga = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['harga'],ENT_QUOTES)))));
        	$check_destinasi = mysqli_query($op, "SELECT * FROM destinasi_restoran WHERE id_restoran = '$post_restoran' AND id_destinasi = '$post_destinasi' AND status = 'show'");
        	if (mysqli_num_rows($check_destinasi) > 0) {
        	    echo "<script>alert('Harga restoran dan destinasi tersebut sudah ada.')</script>";
        	} else {
                $data_nama = mysqli_fetch_assoc(mysqli_query($op, "SELECT destinasi FROM destinasi_kampus WHERE id = '$post_destinasi'"));
                $data_restoran = mysqli_fetch_assoc(mysqli_query($op, "SELECT nama FROM restoran WHERE id = '$post_restoran'"));
        	    $insert = mysqli_query($op, "INSERT INTO destinasi_restoran (id_restoran, id_destinasi, harga, added) VALUES ('$post_restoran', '$post_destinasi', '$post_harga', '".$data_user['id']."')");
        	    if ($insert == TRUE) {
        	        $result = "Harga dari restoran <b>".$data_restoran['nama']." ke ".$data_nama['destinasi']."</b> telah ditambahkan.";
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
        <? } ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Destinasi Restoran</h5>
              <p>Tambahkan dan edit restoran dibawah.</p>
              <!--<div align="right" class="text-right float-right">-->
                <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#tambah" aria-expanded="true" aria-controls="tambah">Tambah</button>
                  <div id="tambah" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <br>
                        <h5>Tambahkan Destinasi setiap Restoran</h5>
                        <form method="POST">
                        <div class="row mb-3">
                            <label for="restoran" class="col-sm-12 col-form-label">Restoran</label>
                            <select id="restoran" name="restoran" class="form-control form-select" required>
                                <option value="">Pilih salah satu...</option>
                                <? $check_restoran = mysqli_query($op, "SELECT * FROM restoran WHERE status = 'show' ORDER BY nama ASC");
                                while($data_restoran = mysqli_fetch_assoc($check_restoran)) { ?>
                                <option value="<? echo $data_restoran['id']; ?>"><? echo $data_restoran['nama']; ?></option>
                                <? } ?>
                            </select>
                        </div>
                        <div class="row mb-3">
                            <label for="destinasi" class="col-sm-12 col-form-label">Destinasi</label>
                            <select id="destinasi" name="destinasi" class="form-control form-select" required>
                                <option value="">Pilih restoran...</option>
                            </select>
                        </div>
                        <div class="row mb-3">
                          <label for="harga" class="col-sm-12 col-form-label">Harga</label>
                          <div class="col-sm-12">
                            <input type="number" name="harga" id="harga" class="form-control" required>
                          </div>
                        </div>
                        </div><br>
                        <div class="modal-footer">
                          <button type="submit" name="tambah" class="btn btn-primary">Tambahkan</button>
                        </div><br>
                      </form>
                    </div>
              <!--</div>-->
              <!-- Table with stripped rows -->
              <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Restoran</th>
                    <th scope="col">Destinasi</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <? 
                $no = 1;
                if (isset($_POST['delete'])) {
                    mysqli_query($op, "UPDATE destinasi_restoran SET status = 'hide', deleted = '".$data_user['id']."' WHERE id = '".$_POST['id']."'");
                    header("Location: ".$cf['url']."admin/destinasi/restoran");
                }
                $check_destinasi = mysqli_query($op, "SELECT * FROM destinasi_restoran WHERE status = 'show' ORDER BY id ASC"); 
                while($data_destinasi = mysqli_fetch_assoc($check_destinasi)) { 
                    $data_nama = mysqli_fetch_assoc(mysqli_query($op, "SELECT destinasi FROM destinasi_kampus WHERE id = '".$data_destinasi['id_destinasi']."'"));
                    $data_restoran = mysqli_fetch_assoc(mysqli_query($op, "SELECT nama FROM restoran WHERE id = '".$data_destinasi['id_restoran']."'"));
                ?>
                  <tr>
                    <th scope="row"><? echo $no++; ?></th>
                    <td><? echo $data_restoran['nama']; ?></td>
                    <td><? echo $data_nama['destinasi']; ?></td>
                    <td>Rp<? echo number_format($data_destinasi['harga'],0,',','.'); ?></td>
                    <td><a href="<? echo $cf['url']; ?>admin/destinasi/edit-restoran?1=<? echo $data_destinasi['id']; ?>" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2/dist/js/select2.min.js"></script>
<script src="'.$cf['url'].'assets/vendor/simple-datatables/simple-datatables.js"></script>
<script>
  $(document).ready(function() {
    $("#restoran").select2();
    $("#destinasi").select2();
    $("#restoran").change(function() {
    var restoranId = $(this).val();
    $.ajax({
      type: "POST",
      url: "restoran-destinasi.php",
      data: { restoran_id: restoranId },
      success: function(response) {
        $("#destinasi").html(response);
        $("#destinasi").select2();
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  });
  });
</script>';
include '../../library/footer.php'; ?>