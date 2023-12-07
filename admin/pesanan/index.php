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
              <h5 class="card-title">Riwayat Pesanan</h5>
              <!-- Table with stripped rows -->
              <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Driver</th>
                    <th scope="col">Tipe</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Status</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Masukan</th>
                    <th scope="col">Tanggal</th>
                  </tr>
                </thead>
                <tbody>
                <? 
                $no = 1;
                $check_pesanan = mysqli_query($op, "SELECT * FROM pesanan ORDER BY id DESC"); 
                while($data_pesanan = mysqli_fetch_assoc($check_pesanan)) { 
                    $data_driver = mysqli_fetch_assoc(mysqli_query($op, "SELECT nama FROM users WHERE id = '".$data_pesanan['id_driver']."'"));
                ?>
                  <tr>
                    <th scope="row"><? echo $no++; ?></th>
                    <td><? if (!empty($data_driver['nama'])) { echo $data_driver['nama']; } else { echo '-'; }?></td>
                    <td><? echo $data_pesanan['tipe']; ?></td>
                    <td>Rp<? echo number_format($data_pesanan['harga'],0,',','.'); ?></td>
                    <td><? echo $data_pesanan['status']; ?></td>
                    <td><? if (empty($data_pesanan['nilai'])) { echo '-'; } else { echo $data_pesanan['nilai']; } ?></td>
                    <td><? if (empty($data_pesanan['masukan'])) { echo '-'; } else { echo $data_pesanan['masukan']; } ?></td>
                    <td><? echo $data_pesanan['created']; ?></td>
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