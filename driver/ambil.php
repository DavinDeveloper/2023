<?
$pl = 'Driver';
$ps = TRUE;
include '../library/configuration.php';
$check_pesanan = mysqli_query($op, "SELECT * FROM pesanan WHERE id = '".$_GET['1']."' AND id_driver IS NULL");
if (mysqli_num_rows($check_pesanan) > 0) {
    $data_pesanan = mysqli_fetch_assoc($check_pesanan);
    $saldo_dibutuhkan = $data_pesanan['harga']/10;
    $data_customer = mysqli_fetch_assoc(mysqli_query($op, "SELECT nama FROM users WHERE id = '".$data_pesanan['id_user']."'"));
    if (!empty($data_pesanan['id_destinasi_kampus'])) {
        $data_destinasi = mysqli_fetch_assoc(mysqli_query($op, "SELECT destinasi FROM destinasi_kampus WHERE id = '".$data_pesanan['id_destinasi_kampus']."'"));
    } else if (!empty($data_pesanan['id_destinasi_lain'])) {
        $data_destinasi = mysqli_fetch_assoc(mysqli_query($op, "SELECT destinasi FROM destinasi_lain WHERE id = '".$data_pesanan['id_destinasi_lain']."'"));
    } else if (!empty($data_pesanan['id_destinasi_restoran'])) {
        $data_destinasi_restoran = mysqli_fetch_assoc(mysqli_query($op, "SELECT * FROM destinasi_restoran WHERE id = '".$data_pesanan['id_destinasi_restoran']."'"));
        $data_restoran = mysqli_fetch_assoc(mysqli_query($op, "SELECT * FROM restoran WHERE id = '".$data_destinasi_restoran['id_restoran']."'"));
        $data_destinasi = mysqli_fetch_assoc(mysqli_query($op, "SELECT destinasi FROM destinasi_kampus WHERE id = '".$data_destinasi_restoran['id_destinasi']."'"));
    }
if ($data_pesanan['tipe'] == 'Healing') {
    if (isset($_POST['ambil'])) {
        if (!empty($data_pesanan['id_driver'])) {
            echo '<script>alert("Sudah ada driver yang ambil pesanan ini.");window.location.href="'.$cf['url'].'";</script>';
        } else if ($data_user['saldo'] < $saldo_dibutuhkan) {
            echo '<script>alert("Saldo anda kurang dari 10% harga pesanan.");window.location.href="'.$cf['url'].'";</script>';
        } else if (empty($_POST['latitude']) OR empty($_POST['longitude'])) {
            echo '<script>alert("Harap aktifkan lokasi anda.");window.location.href="'.$cf['url'].'";</script>';
        } else {
            $update = mysqli_query($op, "UPDATE users SET pesanan = '".$_GET['1']."' WHERE id = '".$data_user['id']."'");
            $update = mysqli_query($op, "UPDATE pesanan SET id_driver = '".$data_user['id']."', latitude_driver = '".$_POST['latitude']."', longitude_driver = '".$_POST['longitude']."', status = 'Diambil' WHERE id = '".$_GET['1']."'");
            if ($update == TRUE) {
                echo '<script>alert("Pesanan berhasil diambil.");window.location.href="'.$cf['url'].'driver/chat?1='.$_GET['1'].'";</script>';
            } else {
                echo '<script>alert("Gagal sistem.")</script>';
            }
        }
    }
} else if ($data_pesanan['tipe'] == 'Berangkat' OR $data_pesanan['tipe'] == 'Pulang' OR $data_pesanan['tipe'] == 'Destinasi Lain' OR $data_pesanan['tipe'] == 'Paket' OR $data_pesanan['tipe'] == 'Makanan') {
    if (isset($_POST['ambil'])) {
        $saldo_driver = $data_user['saldo']-$saldo_dibutuhkan;
        if (!empty($data_pesanan['id_driver'])) {
            echo '<script>alert("Sudah ada driver yang ambil pesanan ini.");window.location.href="'.$cf['url'].'";</script>';
        } else if ($data_user['saldo'] < $saldo_dibutuhkan) {
            echo '<script>alert("Saldo anda kurang dari 10% harga pesanan.");window.location.href="'.$cf['url'].'";</script>';
        } else if (empty($_POST['latitude']) OR empty($_POST['longitude'])) {
            echo '<script>alert("Harap aktifkan lokasi anda.");window.location.href="'.$cf['url'].'";</script>';
        } else {
            $update = mysqli_query($op, "UPDATE users SET pesanan = '".$_GET['1']."', saldo = '$saldo_driver' WHERE id = '".$data_user['id']."'");
            $update = mysqli_query($op, "UPDATE pesanan SET id_driver = '".$data_user['id']."', latitude_driver = '".$_POST['latitude']."', longitude_driver = '".$_POST['longitude']."', status = 'Diambil' WHERE id = '".$_GET['1']."'");
            if ($update == TRUE) {
                echo '<script>alert("Pesanan berhasil diambil.");window.location.href="'.$cf['url'].'driver/pesanan?1='.$_GET['1'].'";</script>';
            } else {
                echo '<script>alert("Gagal sistem.")</script>';
            }
        }
    }
}
} else {
    header("Location: ".$cf['url']);
}
include '../library/header.php';
?>

<main id="main" class="main">
<div class="row">
    <? if ($data_user['saldo'] < $saldo_dibutuhkan) { ?>
                    <div class="card card-body text-center">
                        <table class="mb-0"><br>
                            <tbody> 
                                <tr>
                                    <th>
                                        <div class="text-center w-75 m-auto">
                                            <img loading="lazy" src="<? echo $cf['url']; ?>assets/images/pesanan/x.gif" style="height:200px; width:200px;margin-top: 5px;">
                                        </div><br>
                                        <h6 class="text-dark"><span>Saldo anda kurang dari 10% harga pesanan...</span></h6>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
    <? } else if ($data_pesanan['status'] == 'Dibatalkan') { 
    $data_pembatalan = mysqli_fetch_assoc(mysqli_query($op, "SELECT id_user,alasan FROM riwayat_pembatalan WHERE id_pesanan = '".$_GET['1']."'"));
    $data_pembatal = mysqli_fetch_assoc(mysqli_query($op, "SELECT level FROM users WHERE id = '".$data_pembatalan['id_user']."'"));
    ?>
                    <div class="card card-body text-center">
                        <table class="mb-0"><br>
                            <tbody> 
                                <tr>
                                    <th>
                                        <div class="text-center w-75 m-auto">
                                            <img loading="lazy" src="<? echo $cf['url']; ?>assets/images/pesanan/x.gif" style="height:200px; width:200px;margin-top: 5px;">
                                        </div><br>
                                        <h6 class="text-dark"><span>Pesanan dibatalkan oleh <? echo $data_pembatal['level']; ?> dengan alasan <i><? echo nl2br(str_replace(‘‘, ‘‘, htmlspecialchars($data_pembatalan['alasan']))); ?>.</i></span></h6>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
    <? } else { ?>
        <form class="location" method="POST">
        <input type="hidden" name="latitude" value="">
        <input type="hidden" name="longitude" value="">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
              <? 
                if ($data_pesanan['tipe'] == 'Berangkat') {
                    echo 'Berangkat ke Kampus '.$data_pesanan['kampus'];
                } else if ($data_pesanan['tipe'] == 'Pulang') {
                    echo 'Pulang dari Kampus '.$data_pesanan['kampus'];
                } else if ($data_pesanan['tipe'] == 'Destinasi Lain') {
                    if ($data_pesanan['pemberangkatan'] == 1) {
                        echo 'Perjalanan Destinasi '.$data_destinasi['destinasi1'].' ke '.$data_destinasi['destinasi2'];
                    } else if ($data_pesanan['pemberangkatan'] == 2) {
                        echo 'Perjalanan Destinasi '.$data_destinasi['destinasi2'].' ke '.$data_destinasi['destinasi1'];
                    }
                } else if ($data_pesanan['tipe'] == 'Paket') {
                    if ($data_pesanan['pemberangkatan'] == 1) {
                        echo 'Pengiriman Paket dari '.$data_destinasi['destinasi1'].' ke '.$data_destinasi['destinasi2'];
                    } else if ($data_pesanan['pemberangkatan'] == 2) {
                        echo 'Pengiriman Paket dari '.$data_destinasi['destinasi2'].' ke '.$data_destinasi['destinasi1'];
                    }
                } else if ($data_pesanan['tipe'] == 'Makanan') {
                    echo 'Pemesanan Makanan Restoran '.$data_restoran['nama'];
                }
                ?></h5>
                <iframe loading="lazy" width="100%" height="200" frameborder="0" style="border:0" src="https://maps.google.com/maps?q=<? echo $data_pesanan['latitude_customer']; ?>,<? echo $data_pesanan['longitude_customer']; ?>&z=14&amp;output=embed" allowfullscreen></iframe>
                <p>Lokasi Customer</p><hr>
                
                <? if ($data_pesanan['tipe'] == 'Makanan') { ?>
                <h5><b>Restoran</b></h5>
                <p><i><? echo $data_restoran['nama']; ?><br>
                Lokasi : <? echo nl2br(str_replace(‘‘, ‘‘, htmlspecialchars($data_restoran['lokasi']))); ?></i></p><hr>
                <? } ?>
                <? if (!empty($data_pesanan['catatan'])) { ?>
                <? if ($data_pesanan['tipe'] == 'Makanan') { ?>
                <h5><b>Pesanan Makanan</b></h5>
                <? } else { ?>
                <h5><b>Catatan</b></h5>
                <? } ?>
                <p><i><? echo nl2br(str_replace(‘‘, ‘‘, htmlspecialchars($data_pesanan['catatan']))); ?></i></p><hr>
                <? } ?>
                <? if ($data_pesanan['tipe'] != 'Paket') { ?>
                <h5><b>Patokan</b></h5>
                <p><i><? echo nl2br(str_replace(‘‘, ‘‘, htmlspecialchars($data_pesanan['patokan']))); ?></i></p><hr>
                <? } ?>
                <? if ($data_pesanan['tipe'] == 'Berangkat') { ?>
                <h5><b>Tujuan</b></h5>
                <p><i>Kampus <? echo $data_pesanan['kampus']; ?></i></p><hr>
                <? } else if ($data_pesanan['tipe'] == 'Pulang') { ?>
                <h5><b>Tujuan</b></h5>
                <p><i><? echo $data_destinasi['destinasi']; ?></i></p><hr>
                <? } else if ($data_pesanan['tipe'] == 'Makanan') { ?>
                <h5><b>Tujuan</b></h5>
                <p><i><? echo $data_destinasi['destinasi']; ?></i></p><hr>
                <? } else if ($data_pesanan['tipe'] == 'Healing') { ?>
                <h5><b>Tujuan</b></h5>
                <p><i><? echo $data_pesanan['destinasi_healing']; ?></i></p><hr>
                <? } ?>
                <? if ($data_pesanan['tipe'] == 'Paket') { ?>
                <h5><b>Alamat Pengantaran</b></h5>
                <p><i><? echo nl2br(str_replace(‘‘, ‘‘, htmlspecialchars($data_pesanan['patokan']))); ?></i></p><hr>
                <? } ?>
                <? if ($data_pesanan['tipe'] == 'Healing') { ?>
                <h5><b>PERINGATAN</b></h5>
                <p><i>PASTIKAN HARGA YANG AKAN DISEPAKATI DENGAN CUSTOMER TIDAK LEBIH DARI Rp<? echo number_format($data_user['saldo']*10,0,',','.'); ?></i></p><hr>
                <? } else { ?>
                <h5><b>Harga</b></h5>
                <p><i>Rp<? echo number_format($data_pesanan['harga'],0,',','.'); ?></i></p><hr>
                <h5><b>Biaya Admin</b></h5>
                <p><i>Rp<? echo number_format($saldo_dibutuhkan,0,',','.'); ?></i></p><hr>
                <? } ?>
                <h5><b>Pembayaran</b></h5>
                <p><i><? echo $data_pesanan['pembayaran']; ?></i></p><hr>
                <h5><b>Customer</b></h5>
                <p><i><? echo $data_customer['nama']; ?></i></p>
                <button type="submit" name="ambil" class="btn btn-primary">Ambil</button><hr>
            </div>
          </div>
        </div>
        </form>
    <? } ?>
</div>
</main>

<?
$js .= '
<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        }
    }
    function showPosition(position) {
        document.querySelector(".location input[name=\'latitude\']").value = position.coords.latitude;
        document.querySelector(".location input[name=\'longitude\']").value = position.coords.longitude;
    }
    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert("Allow your location for next.");
                location.reload();
                break;
        }
    }
    function submitForm(action) {
        document.getElementById("kirimLokasi").action = action;
        document.getElementById("kirimLokasi").submit();
    }
</script>';
include '../library/footer.php'; ?>