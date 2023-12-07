<?
$pt = TRUE;
include '../library/configuration.php';
include '../library/header.php';
?>

<main id="main" class="main">
<div class="row">
<section class="section contact">

      <div class="card">
            <div class="card-body">
              <h5 class="card-title">Join Group</h5>
            <?
            $check_group = mysqli_query($op, "SELECT * FROM config_group WHERE status = 'show'");
            while($data_group = mysqli_fetch_assoc($check_group)) {
            ?>
              <!-- List group with Advanced Contents -->
              <div class="list-group">
                <a href="<? echo $data_group['url']; ?>" target="_blank" class="list-group-item list-group-item-action">
                  <div class="d-flex w-100 justify-content-between">
                    <h6 class="mb-1"><? echo $data_group['nama']; ?></h6>
                    <small class="text-muted"></small>
                  </div>
                  <small class="text-muted"><? echo $data_group['platform']; ?></small>
                </a>
              <!-- End List group Advanced Content -->
            <? } ?>
            </div>
          </div>

    </section>
</div>
</main>

<? include '../library/footer.php'; ?>