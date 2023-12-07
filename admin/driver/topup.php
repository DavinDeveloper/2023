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
              <h5 class="card-title">Topup Saldo Driver</h5>
              <p>Silahkan konfirmasi topup saldo dibawah.</p>

              <!-- Table with stripped rows -->
              <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Catatan</th>
                    <th scope="col">Metode</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <? 
                $no = 1;
                if (isset($_POST['confirm'])) {
                    $check_topup_saldo = mysqli_query($op, "SELECT * FROM topup_saldo WHERE id = '".$_POST['id']."'");
                    $data_topup_saldo = mysqli_fetch_assoc($check_topup_saldo);
                    $check_driver_topup = mysqli_query($op, "SELECT * FROM users WHERE id = '".$data_topup_saldo['id_user']."'");
                    $data_driver_topup = mysqli_fetch_assoc($check_driver_topup);
                    $saldo = $data_driver_topup['saldo']+$data_topup_saldo['nominal'];
                    mysqli_query($op, "UPDATE users SET saldo = '$saldo' WHERE id = '".$data_driver_topup['id']."'");
                    mysqli_query($op, "UPDATE topup_saldo SET status = 'Berhasil', validasi = NOW() WHERE id = '".$data_topup_saldo['id']."'");
                    whatsapp($data_driver_topup['telepon'], 'Topup saldo kamu senilai Rp'.number_format($data_topup_saldo['nominal'],0,',','.').' sudah dikonfirmasi sama admin, yuk aktifkan penarikan '.$cf['name'].' sekarang.');
                    header("Location: ".$cf['url']."admin/driver/topup");
                }
                if (isset($_POST['cancel'])) {
                    $check_topup_saldo = mysqli_query($op, "SELECT * FROM topup_saldo WHERE id = '".$_POST['id']."'");
                    $data_topup_saldo = mysqli_fetch_assoc($check_topup_saldo);
                    $check_driver_topup = mysqli_query($op, "SELECT * FROM users WHERE id = '".$data_topup_saldo['id_user']."'");
                    $data_driver_topup = mysqli_fetch_assoc($check_driver_topup);
                    mysqli_query($op, "UPDATE topup_saldo SET status = 'Dibatalkan' WHERE id = '".$data_topup_saldo['id']."'");
                    whatsapp($data_driver_topup['telepon'], 'Topup saldo kamu senilai Rp'.number_format($data_topup_saldo['nominal'],0,',','.').' sudah dibatalkan sama admin, silahkan melakukan topup saldo selanjutnya.');
                    header("Location: ".$cf['url']."admin/driver/topup");
                }
                // $check_topup = mysqli_query($op, "SELECT * FROM topup_saldo WHERE status = 'Menunggu'");
                $check_menunggu = mysqli_query($op, "SELECT * FROM topup_saldo WHERE status = 'Menunggu'");
                if (mysqli_num_rows($check_menunggu) > 0) {
                    $check_topup = mysqli_query($op, "SELECT * FROM topup_saldo ORDER BY status ASC");
                } else {
                    $check_topup = mysqli_query($op, "SELECT * FROM topup_saldo ORDER BY id DESC");
                }
                while($data_topup = mysqli_fetch_assoc($check_topup)) {
                    $data_driver = mysqli_fetch_assoc(mysqli_query($op, "SELECT * FROM users WHERE id = '".$data_topup['id_user']."'"));
                ?>
                  <tr>
                    <th scope="row"><? echo $no++; ?></th>
                    <td><? echo $data_driver['nama']; ?></td>
                    <td><? echo $data_driver['email']; ?></td>
                    <td>Rp<? echo number_format($data_topup['nominal'],0,',','.'); ?></td>
                    <td><? echo $data_topup['catatan']; ?></td>
                    <td><? echo $data_topup['metode']; ?></td>
                    <td>
                    <? if ($data_topup['status'] == 'Menunggu') { ?>
                    <form method="POST">
                    <input name="id" value="<? echo $data_topup['id']; ?>" hidden>
                    <button type="submit" name="cancel" class="btn btn-danger"><i class="bi bi-x-circle"></i></button>
                    <button type="submit" name="confirm" class="btn btn-success"><i class="bi bi-check-circle"></i></button>
                    </form>
                    <? } else if ($data_topup['status'] == 'Dibatalkan') { ?>
                    <button class="btn btn-warning">Dibatalkan</button>
                    <? } else if ($data_topup['status'] == 'Berhasil') { ?>
                    <button class="btn btn-success">Berhasil</button>
                    <? } ?>
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