<?
$pl = 'Admin';
$ps = TRUE;
$css .= '
<link href="'.$cf['url'].'assets/vendor/simple-datatables/style.css" rel="stylesheet">';
include '../../library/configuration.php'; 
include '../../library/header.php';
?>
<main id="main" class="main">
    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Driver</h5>
              <p>Silahkan konfirmasi data driver dibawah.</p>

              <!-- Table with stripped rows -->
              <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Identitas</th>
                    <th scope="col">Muka</th>
                    <th scope="col">Motor</th>
                    <th scope="col">Warna Motor</th>
                    <th scope="col">Plat Motor</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <? 
                $no = 1;
                if (isset($_POST['confirm'])) {
                    mysqli_query($op, "UPDATE users SET status = 'Active', upload = 'Confirmed' WHERE id = '".$_POST['id']."'");
                    whatsapp($_POST['telepon'], 'Akun driver kamu sudah dikonfirmasi sama admin, yuk gunakan '.$cf['name'].' sekarang.');
                    header("Location: ".$cf['url']."admin/driver/pending");
                }
                if (isset($_POST['reject'])) {
                    mysqli_query($op, "UPDATE users SET upload = 'Rejected' WHERE id = '".$_POST['id']."'");
                    whatsapp($_POST['telepon'], 'Upload data driver kamu ditolak nih, coba upload lagi ya dengan jelas dan memasukan data dengan benar.');
                    header("Location: ".$cf['url']."admin/driver/pending");
                }
                $check_driver = mysqli_query($op, "SELECT * FROM users WHERE level = 'Driver' AND upload = 'Pending' AND status = 'Pending'"); 
                while($data_driver = mysqli_fetch_assoc($check_driver)) {?>
                  <tr>
                    <th scope="row"><? echo $no++; ?></th>
                    <td><? echo $data_driver['nama']; ?></td>
                    <td><a href="<? echo $data_driver['identitas']; ?>" target="_blank">Check</a></td>
                    <td><a href="<? echo $data_driver['driver_face']; ?>" target="_blank">Check</a></td>
                    <td><? echo $data_driver['driver_merk']; ?></td>
                    <td><? echo $data_driver['driver_warna']; ?></td>
                    <td><? echo $data_driver['driver_plat']; ?></td>
                    <td>
                    <form method="POST">
                    <input name="id" value="<? echo $data_driver['id']; ?>" hidden>
                    <input name="telepon" value="<? echo $data_driver['telepon']; ?>" hidden>
                    <button type="submit" name="reject" class="btn btn-danger"><i class="bi bi-x-circle"></i></button>
                    <button type="submit" name="confirm" class="btn btn-success"><i class="bi bi-check-circle"></i></button>
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