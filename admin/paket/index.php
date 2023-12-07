<?
$pl = 'Admin';
$ps = TRUE;
$css .= '
<link href="'.$cf['url'].'assets/vendor/simple-datatables/style.css" rel="stylesheet">';
include '../../library/configuration.php'; 
        if (isset($_POST['tambah'])) {
        	$post_nama = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['nama'],ENT_QUOTES)))));
        	$check_kategori = mysqli_query($op, "SELECT * FROM kategori_paket WHERE nama = '$post_nama'");
        	if (mysqli_num_rows($check_kategori) > 0) {
        	    echo "<script>alert('Kategori tersebut sudah ada.')</script>";
        	} else {
        	$insert = mysqli_query($op, "INSERT INTO kategori_paket (nama) VALUES ('$post_nama')");
            if ($insert == TRUE) {
                $result = "Kategori paket berhasil ditambahkan.";
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
              <h5 class="card-title">Data Kategori Paket</h5>
              <p>Tambahkan dan edit kategori paket dibawah.</p>
              <!--<div align="right" class="text-right float-right">-->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
              <!--</div>-->
                <div class="modal fade" id="tambah" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Tambah Kategori Paket</h5>
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
                    <th scope="col">Nama Kategori</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <? 
                $no = 1;
                if (isset($_POST['delete'])) {
                    mysqli_query($op, "UPDATE kategori_paket SET status = 'hide' WHERE id = '".$_POST['id']."'");
                    header("Location: ".$cf['url']."admin/paket");
                }
                $check_kategori = mysqli_query($op, "SELECT * FROM kategori_paket WHERE status = 'show' ORDER BY nama ASC"); 
                while($data_kategori = mysqli_fetch_assoc($check_kategori)) {?>
                  <tr>
                    <th scope="row"><? echo $no++; ?></th>
                    <td><? echo $data_kategori['nama']; ?></td>
                    <td><a href="<? echo $cf['url']; ?>admin/paket/edit?1=<? echo $data_kategori['id']; ?>" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                    <form method="POST">
                    <input name="id" value="<? echo $data_kategori['id']; ?>" hidden>
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