<?
$pl = 'Admin';
$ps = TRUE;
$css .= '
<link href="'.$cf['url'].'assets/vendor/simple-datatables/style.css" rel="stylesheet">';
include '../../library/configuration.php'; 
        if (isset($_POST['tambah'])) {
        	$post_nama = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['nama'],ENT_QUOTES)))));
        	$post_nomor = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['nomor'],ENT_QUOTES)))));
        	$post_alias = $op->real_escape_string(strtoupper(trim(stripslashes(strip_tags(htmlspecialchars($_POST['alias'],ENT_QUOTES))))));
        	$file = $_FILES['file']['name'];
        	if (!empty($file)) {
            	$x = explode('.', $file);
            	$ekstensi = strtolower(end($x));
            	$size = $_FILES['file']['size'];
            	$file_tmp = $_FILES['file']['tmp_name'];
            	$upload = str_replace(":","-",date("H:i:s"))."-davin-wardana-".random(10).".".$ekstensi;
            	$result = $cf['url']."assets/images/pembayaran/".$upload;
            	move_uploaded_file($file_tmp, '../../assets/images/pembayaran/'.$upload);
        	}
        	$insert = mysqli_query($op, "INSERT INTO metode_pembayaran (nama, nomor, alias, qr) VALUES ('$post_nama', '$post_nomor', '$post_alias', '$result')");
            if ($insert == TRUE) {
                $result = "Metode pembayaran berhasil ditambahkan.";
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
        <? } ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Metode Pembayaran</h5>
              <p>Tambahkan dan edit metode pembayaran dibawah.</p>
              <!--<div align="right" class="text-right float-right">-->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
              <!--</div>-->
                <div class="modal fade" id="tambah" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Tambah Metode Pembayaran</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="card">
                        <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                        <div class="row mb-3">
                          <label for="nama" class="col-sm-12 col-form-label">Nama Bank/Wallet</label>
                          <div class="col-sm-12">
                            <input type="text" name="nama" id="nama" class="form-control" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="nomor" class="col-sm-12 col-form-label">Nomor Rekening (kosongkan jika qris)</label>
                          <div class="col-sm-12">
                            <input type="text" name="nomor" id="nomor" class="form-control" >
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="file" class="col-sm-12 col-form-label">QRIS (kosongkan jika bukan qris)</label>
                          <div class="col-sm-12">
                            <input class="form-control" type="file" name="file" id="file">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="alias" class="col-sm-12 col-form-label">Pemilik Bank/Penerima Pembayaran</label>
                          <div class="col-sm-12">
                            <input type="text" name="alias" id="alias" class="form-control" required>
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
                    <th scope="col">Nama Bank/Wallet</th>
                    <th scope="col">Nomor</th>
                    <th scope="col">QR</th>
                    <th scope="col">Alias</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <? 
                $no = 1;
                if (isset($_POST['delete'])) {
                    mysqli_query($op, "UPDATE metode_pembayaran SET status = 'hide' WHERE id = '".$_POST['id']."'");
                    header("Location: ".$cf['url']."admin/pembayaran");
                }
                $check_pembayaran = mysqli_query($op, "SELECT * FROM metode_pembayaran WHERE status = 'show' ORDER BY nama ASC"); 
                while($data_pembayaran = mysqli_fetch_assoc($check_pembayaran)) {?>
                  <tr>
                    <th scope="row"><? echo $no++; ?></th>
                    <td><? echo $data_pembayaran['nama']; ?></td>
                    <td><? if (empty($data_pembayaran['nomor'])) { ?>-<? } else { ?><? echo $data_pembayaran['nomor']; } ?></td>
                    <td><? if (empty($data_pembayaran['qr'])) { ?>-<? } else { ?><a href="<? echo $data_pembayaran['qr']; ?>" target="_blank">Check</a><? } ?></td>
                    <td><? echo $data_pembayaran['alias']; ?></td>
                    <td><a href="<? echo $cf['url']; ?>admin/pembayaran/edit?1=<? echo $data_pembayaran['id']; ?>" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                    <form method="POST">
                    <input name="id" value="<? echo $data_pembayaran['id']; ?>" hidden>
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