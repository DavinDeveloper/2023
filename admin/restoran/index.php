<?
$pl = 'Admin';
$ps = TRUE;
$css .= '
<link href="'.$cf['url'].'assets/vendor/simple-datatables/style.css" rel="stylesheet">';
include '../../library/configuration.php'; 
        if (isset($_POST['tambah'])) {
        	$post_nama = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['nama'],ENT_QUOTES)))));
        	$post_lokasi = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['lokasi'],ENT_QUOTES)))));
        	$post_menu = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['menu'],ENT_QUOTES)))));
        	$insert = mysqli_query($op, "INSERT INTO restoran (nama, lokasi, menu) VALUES ('$post_nama', '$post_lokasi', '$post_menu')");
            if ($insert == TRUE) {
                $result = "Restoran berhasil ditambahkan.";
        	} else {
        	    echo "<script>alert('Gagal sistem.')</script>";
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
        $check_restoran_input = mysqli_query($op, "SELECT * FROM restoran_input WHERE status = 'show' ORDER BY id DESC"); 
        if (mysqli_num_rows($check_restoran_input) > 0) { ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Restoran Input</h5>
              <p>Konfirmasi restoran masukan dari customer.</p>
              <!-- Table with stripped rows -->
              <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Restoran</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <? 
                $no = 1;
                if (isset($_POST['delete'])) {
                    mysqli_query($op, "UPDATE restoran_input SET status = 'hide' WHERE id = '".$_POST['id']."'");
                    header("Location: ".$cf['url']."admin/restoran");
                }
                while($data_restoran_input = mysqli_fetch_assoc($check_restoran_input)) {?>
                  <tr>
                    <th scope="row"><? echo $no++; ?></th>
                    <td><? echo $data_restoran_input['nama']; ?></td>
                    <td>
                    <form method="POST">
                    <input name="id" value="<? echo $data_restoran_input['id']; ?>" hidden>
                    <button type="submit" name="delete" class="btn btn-danger"><i class="bi bi-x-circle"></i></button>
                    </form>
                    <a href="<? echo $cf['url']; ?>admin/restoran/edit-input?1=<? echo $data_restoran_input['id']; ?>" class="btn btn-success"><i class="bi bi-check-circle"></i></a>
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
              <h5 class="card-title">Data Restoran</h5>
              <p>Tambahkan dan edit restoran dibawah.</p>
              <!--<div align="right" class="text-right float-right">-->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
              <!--</div>-->
                <div class="modal fade" id="tambah" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Tambah Restoran</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="card">
                        <div class="card-body">
                        <form method="POST">
                        <div class="row mb-3">
                          <label for="nama" class="col-sm-12 col-form-label">Nama Restoran</label>
                          <div class="col-sm-12">
                            <input type="text" name="nama" id="nama" class="form-control" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="lokasi" class="col-sm-12 col-form-label">Lokasi Restoran</label>
                          <div class="col-sm-12">
                            <textarea type="text" name="lokasi" id="lokasi" class="form-control" required></textarea>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="menu" class="col-sm-12 col-form-label">Menu Restoran</label>
                          <div class="col-sm-12">
                            <textarea type="text" name="menu" id="menu" class="form-control" rows="6" required></textarea>
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
                    <th scope="col">Nama Restoran</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <? 
                $no = 1;
                if (isset($_POST['delete'])) {
                    mysqli_query($op, "UPDATE restoran SET status = 'hide' WHERE id = '".$_POST['id']."'");
                    header("Location: ".$cf['url']."admin/restoran");
                }
                $check_restoran = mysqli_query($op, "SELECT * FROM restoran WHERE status = 'show' ORDER BY nama ASC"); 
                while($data_restoran = mysqli_fetch_assoc($check_restoran)) {?>
                  <tr>
                    <th scope="row"><? echo $no++; ?></th>
                    <td><? echo $data_restoran['nama']; ?></td>
                    <td><? echo $data_restoran['lokasi']; ?></td>
                    <td><a href="<? echo $cf['url']; ?>admin/restoran/edit?1=<? echo $data_restoran['id']; ?>" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                    <form method="POST">
                    <input name="id" value="<? echo $data_restoran['id']; ?>" hidden>
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