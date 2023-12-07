<?
$pl = 'Driver';
$ps = TRUE;
$css .= '
<link href="'.$cf['url'].'assets/vendor/simple-datatables/style.css" rel="stylesheet">';
include '../library/configuration.php';
include '../library/header.php';
?>
<main id="main" class="main">
    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Riwayat Topup Saldo</h5>
              <!-- Table with stripped rows -->
              <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Metode</th>
                    <th scope="col">Catatan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tanggal</th>
                  </tr>
                </thead>
                <tbody>
                <? 
                $no = 1;
                $check_topup = mysqli_query($op, "SELECT * FROM topup_saldo WHERE id_user = '".$data_user['id']."' ORDER BY id DESC"); 
                while($data_topup = mysqli_fetch_assoc($check_topup)) {?>
                  <tr>
                    <th scope="row"><? echo $no++; ?></th>
                    <td>Rp<? echo number_format($data_topup['nominal'],0,',','.'); ?></td>
                    <td><? echo $data_topup['metode']; ?></td>
                    <td><? echo $data_topup['catatan']; ?></td>
                    <td><? echo $data_topup['status']; ?></td>
                    <td><? echo $data_topup['created']; ?></td>
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
include '../library/footer.php'; ?>