<?
$pt = TRUE;
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
                <i class="bi bi-geo-alt"></i>
                <h3>Alamat</h3>
                <p><? echo $cc['alamat']; ?></p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-telephone"></i>
                <h3>WhatsApp</h3>
                <p>+<? echo $cc['telepon']; ?></p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-envelope"></i>
                <h3>Email</h3>
                <p><? echo $cc['email']; ?></p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-clock"></i>
                <h3>Jam Operasional</h3>
                <p><? echo nl2br(str_replace(‘‘, ‘‘, htmlspecialchars($cc['operasional']))); ?></p>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section>
</div>
</main>

<? include '../library/footer.php'; ?>