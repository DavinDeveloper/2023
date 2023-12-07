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
              <h5 class="card-title">Penghasilan Harian</h5>
              <!-- Table with stripped rows -->
              <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Penghasilan</th>
                  </tr>
                </thead>
                <tbody>
                <? 
                $no = 1;
                $check_penghasilan = mysqli_query($op, "SELECT DATE(created) as tanggal, SUM(harga) as total_penghasilan FROM pesanan WHERE id_driver = '".$data_user['id']."' AND status = 'Selesai' GROUP BY tanggal ORDER BY tanggal DESC"); 
                while($data_penghasilan = mysqli_fetch_assoc($check_penghasilan)) {?>
                  <tr>
                    <th scope="row"><? echo $no++; ?></th>
                    <td><? echo $data_penghasilan['tanggal']; ?></td>
                    <td>Rp<? echo number_format($data_penghasilan['total_penghasilan'],0,',','.'); ?></td>
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