<?
$pl = 'Admin';
$ps = TRUE;
include '../library/configuration.php'; 
include '../library/header.php';
?>
<main id="main" class="main">
<div class="row">
<section class="section contact">

      <div class="row gy-4">

        <div class="col-xl-12">

          <div class="row">
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-person"></i>
                <h3><? echo number_format(mysqli_num_rows(mysqli_query($op, "SELECT * FROM users WHERE level = 'Customer'")),0,',','.'); ?></h3>
                <p>Customer</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-person"></i>
                <h3><? echo number_format(mysqli_num_rows(mysqli_query($op, "SELECT * FROM users WHERE level = 'Driver'")),0,',','.'); ?></h3>
                <p>Driver</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-cart3"></i>
                <h3><? echo number_format(mysqli_num_rows(mysqli_query($op, "SELECT * FROM pesanan WHERE status = 'Selesai'")),0,',','.'); ?></h3>
                <p>Pesanan</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-star"></i>
                <h3><? echo number_format(mysqli_num_rows(mysqli_query($op, "SELECT * FROM riwayat_penilaian")),0,',','.'); ?></h3>
                <p>Masukan</p>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section>
</div>
</main>

<? include '../library/footer.php'; ?>