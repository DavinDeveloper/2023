<?
$pl = 'Admin';
$ps = TRUE;
$css .= '
<link href="'.$cf['url'].'assets/vendor/simple-datatables/style.css" rel="stylesheet">';
include '../../library/configuration.php'; 
        if (isset($_POST['tambah'])) {
        	$post_judul = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['judul'],ENT_QUOTES)))));
        	$post_mulai = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['mulai'],ENT_QUOTES)))));
        	$post_selesai = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['selesai'],ENT_QUOTES)))));
        	$file = $_FILES['file']['name'];
        	if ($post_mulai > $post_selesai) {
        	    echo "<script>alert('Mulai tampil harus lebih awal dari selesai tampil.')</script>";
        	} else if (empty($file)) {
        	    echo "<script>alert('Harap upload gambar.')</script>";
        	} else {
            	$x = explode('.', $file);
            	$ekstensi = strtolower(end($x));
            	$size = $_FILES['file']['size'];
            	$file_tmp = $_FILES['file']['tmp_name'];
            	$upload = str_replace(":","-",$post_mulai)."-davin-wardana-".random(10).".".$ekstensi;
            	$result = $cf['url']."assets/images/iklan/".$upload;
            	move_uploaded_file($file_tmp, '../../assets/images/iklan/'.$upload);
        	    $insert = mysqli_query($op, "INSERT INTO iklan (judul, gambar, mulai, selesai) VALUES ('$post_judul', '$result', '$post_mulai', '$post_selesai')");
        	    if ($insert == TRUE) {
        	        $result = "Iklan berhasil ditambahkan.";
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
              <h5 class="card-title">Data Iklan</h5>
              <p>Tambahkan dan edit iklan dibawah.</p>
              <!--<div align="right" class="text-right float-right">-->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
              <!--</div>-->
                <div class="modal fade" id="tambah" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Tambah Iklan</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="card">
                        <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                        <div class="row mb-3">
                          <label for="judul" class="col-sm-12 col-form-label">Judul</label>
                          <div class="col-sm-12">
                            <input type="text" name="judul" id="judul" class="form-control" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="file" class="col-sm-12 col-form-label">Gambar (1000x600)</label>
                          <div class="col-sm-12">
                            <input class="form-control" type="file" name="file" id="file" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="mulai" class="col-sm-12 col-form-label">Mulai Tampil</label>
                          <div class="col-sm-12">
                            <input type="date" name="mulai" id="mulai" class="form-control" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="selesai" class="col-sm-12 col-form-label">Selesai Tampil</label>
                          <div class="col-sm-12">
                            <input type="date" name="selesai" id="selesai" class="form-control" required>
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
                    <th scope="col">Judul</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Mulai</th>
                    <th scope="col">Selesai</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <? 
                $no = 1;
                if (isset($_POST['delete'])) {
                    mysqli_query($op, "UPDATE iklan SET status = 'hide' WHERE id = '".$_POST['id']."'");
                    header("Location: ".$cf['url']."admin/iklan");
                }
                $check_iklan = mysqli_query($op, "SELECT * FROM iklan WHERE status = 'show' ORDER BY id DESC"); 
                while($data_iklan = mysqli_fetch_assoc($check_iklan)) {?>
                  <tr>
                    <th scope="row"><? echo $no++; ?></th>
                    <td><? echo $data_iklan['judul']; ?></td>
                    <td><a href="<? echo $data_iklan['gambar']; ?>" target="_blank">Check</a></td>
                    <td><? echo $data_iklan['mulai']; ?></td>
                    <td><? echo $data_iklan['selesai']; ?></td>
                    <td><a href="<? echo $cf['url']; ?>admin/iklan/edit?1=<? echo $data_iklan['id']; ?>" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                    <form method="POST">
                    <input name="id" value="<? echo $data_iklan['id']; ?>" hidden>
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