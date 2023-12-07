<?
$pl = 'Driver';
$ps = TRUE;
include '../library/configuration.php';
if ($data_user['upload'] == 'Nothing' OR $data_user['upload'] == 'Rejected' OR $data_user['upload'] == 'Pending' OR $data_user['status'] == 'Pending') {
    header("Location: ".$cf['url']."driver/upload");
}
if ($data_user['saldo'] == 0 AND $data_user['stay'] != 'Off') {
    mysqli_query($op, "UPDATE users SET stay = 'Off' WHERE id = '".$data_user['id']."'");
} else if (!empty($data_user['pesanan'])) {
    header("Location: ".$cf['url']."driver/pesanan?1=".$data_user['pesanan']);
}

include '../library/header.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['aktif'])) {
        mysqli_query($op, "UPDATE users SET stay = 'On' WHERE id = '".$data_user['id']."'");
        header("Location: ".$cf['url']);
    }
    if (isset($_POST['mati'])) {
        mysqli_query($op, "UPDATE users SET stay = 'Off' WHERE id = '".$data_user['id']."'");
        header("Location: ".$cf['url']);
    }
  if (isset($_POST['csrf']) && $_POST['csrf'] === $_SESSION['csrf']) {
      if (isset($_POST['topup'])) {
        $post_nominal = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['nominal'],ENT_QUOTES)))));
        $post_metode = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['metode'],ENT_QUOTES)))));
        $post_catatan = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['catatan'],ENT_QUOTES)))));
        $check_topup = mysqli_query($op, "SELECT * FROM topup_saldo WHERE id_user = '".$data_user['id']."' AND status = 'Pending'");
          if (mysqli_num_rows($check_topup) > 0) {
              echo '<script>alert("Masih ada topup saldo yang pending.")</script>';
          } else {
              $insert = mysqli_query($op, "INSERT INTO topup_saldo (id_user,nominal,metode,catatan) VALUES ('".$data_user['id']."','$post_nominal','$post_metode','$post_catatan')");
              if ($insert == TRUE) {
                  $_SESSION['topup']['message'] = "Topup saldo telah dibuat, silahkan transfer atau bayar ke admin agar saldo dapat diproses.";
                  $_SESSION['topup']['time'] = date("H:i");
                  header("Location: ".$cf['url']);
              } else {
                  echo '<script>alert("Gagal sistem.")</script>';
              }
          }
      }
  }
}
if ($_SESSION['topup']['time'] != date("H:i")) {
    unset($_SESSION['topup']);
}
?>

<main id="main" class="main">
<div class="row">
        <? if (isset($_SESSION['topup'])) { ?>
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <? echo $_SESSION['topup']['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <? } ?>
            <div class="card">
            <div class="card-body">
              <h5 class="card-title">Saldo</h5>
              <p>Rp<? echo number_format($data_user['saldo'],0,',','.'); ?></p>
              <form method="POST">
              <a data-bs-toggle="modal" data-bs-target="#topup" class="btn btn-outline-primary">Topup</a>
              <? if ($data_user['saldo'] > 0) { ?>
              <button type="submit" name="aktif" class="btn btn-<? if ($data_user['stay'] != 'On') { ?>outline-<? } ?>success">Aktif</button>
              <button type="submit" name="mati" class="btn btn-<? if ($data_user['stay'] != 'Off') { ?>outline-<? } ?>danger">Mati</button>
              <? } ?>
              </form>
                <form method="POST">
                <input type="hidden" name="csrf" value="<? echo csrf(); ?>">
                <div class="modal fade" id="topup" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Topup Saldo</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="card">
                        <div class="card-body">
                        <div class="row mb-3">
                          <label for="nominal" class="col-sm-12 col-form-label">Nominal</label>
                          <div class="col-sm-12">
                            <input type="number" name="nominal" id="nominal" min="10000" class="form-control" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                        <label for="metode" class="col-sm-12 col-form-label">Metode Pembayaran</label>
                        <div class="col-sm-12">
                        <select id="metode" name="metode" class="form-control" required>
                            <option value="Cash">Cash</option>
                            <? $check_pembayaran = mysqli_query($op, "SELECT * FROM metode_pembayaran WHERE status = 'show' ORDER BY nama ASC");
                            while($data_pembayaran = mysqli_fetch_assoc($check_pembayaran)) { ?>
                            <option value="<? echo $data_pembayaran['nama']; ?>"><? echo $data_pembayaran['nama']; ?></option>
                            <? } ?>
                        </select></div><br>
                        </div>
                        <div class="row mb-3">
                          <label for="catatan" class="col-sm-12 col-form-label">Catatan</label>
                          <div class="col-sm-12">
                            <input type="text" name="catatan" id="catatan" class="form-control">
                          </div>
                        </div>
                        </div></div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" name="topup" class="btn btn-primary">Topup</button>
                        </div>
                      </div>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        
</div>
<div id="pesanan-container" class="row"></div>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function loadPesanan() {
    $.ajax({
      url: 'ajax_pesanan.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        $('#pesanan-container').empty();
        $.each(data, function(index, item) {
          var card = `
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">${item.nama}</h5>
                <p>${item.harga}</p>
                <p>${item.keterangan}</p>
                <div align="right" class="text-right float-right">
                  <a href="<? echo $cf['url']; ?>driver/ambil?1=${item.id}" class="btn btn-primary">Ambil</a>
                </div>
              </div>
            </div>
          `;
          $('#pesanan-container').append(card);
        });
      }
    });
  }
  loadPesanan();

  setInterval(function() {
    loadPesanan();
  }, 1000);
</script>
<? include '../library/footer.php'; ?>