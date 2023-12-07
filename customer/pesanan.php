<?
$pl = 'Customer';
$ps = TRUE;
include '../library/configuration.php';
$check_pesanan = mysqli_query($op, "SELECT * FROM pesanan WHERE id = '".$_GET['1']."'");
if (mysqli_num_rows($check_pesanan) > 0) {
    $data_pesanan = mysqli_fetch_assoc($check_pesanan);
    $data_driver = mysqli_fetch_assoc(mysqli_query($op, "SELECT * FROM users WHERE id = '".$data_pesanan['id_driver']."'"));
    if (!empty($data_pesanan['id_destinasi_kampus'])) {
        $data_destinasi = mysqli_fetch_assoc(mysqli_query($op, "SELECT destinasi FROM destinasi_kampus WHERE id = '".$data_pesanan['id_destinasi_kampus']."'"));
    } else if (!empty($data_pesanan['id_destinasi_lain'])) {
        $data_destinasi = mysqli_fetch_assoc(mysqli_query($op, "SELECT destinasi1,destinasi2 FROM destinasi_lain WHERE id = '".$data_pesanan['id_destinasi_lain']."'"));
    } else if (!empty($data_pesanan['id_destinasi_restoran'])) {
        $data_destinasi_restoran = mysqli_fetch_assoc(mysqli_query($op, "SELECT * FROM destinasi_restoran WHERE id = '".$data_pesanan['id_destinasi_restoran']."'"));
        $data_restoran = mysqli_fetch_assoc(mysqli_query($op, "SELECT * FROM restoran WHERE id = '".$data_destinasi_restoran['id_restoran']."'"));
        $data_destinasi = mysqli_fetch_assoc(mysqli_query($op, "SELECT destinasi FROM destinasi_kampus WHERE id = '".$data_destinasi_restoran['id_destinasi']."'"));
    }
    
    if (isset($_POST['batal'])) {
        $post_alasan = $op->real_escape_string(strtoupper(trim(stripslashes(strip_tags(htmlspecialchars($_POST['alasan'],ENT_QUOTES))))));
        if ($data_pesanan['status'] != 'Menunggu') {
            echo '<script>alert("Pesanan tidak bisa dibatalkan.");window.location.href="'.$cf['url'].'";</script>';
        } else {
        mysqli_query($op, "UPDATE pesanan SET status = 'Dibatalkan' WHERE id = '".$_GET['1']."'");
        mysqli_query($op, "UPDATE users SET pesanan = NULL WHERE id = '".$data_user['id']."'");
        $insert = mysqli_query($op, "INSERT INTO riwayat_pembatalan (id_user,id_pesanan,alasan) VALUES ('".$data_user['id']."', '".$_GET['1']."', '$post_alasan')");
        if ($insert == TRUE) {
            echo '<script>alert("Pesanan berhasil dibatalkan.");window.location.href="'.$cf['url'].'";</script>';
        } else {
            echo '<script>alert("Gagal sistem.");window.location.href="'.$cf['url'].'";</script>';
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
    <? if (empty($data_pesanan['id_driver']) AND $data_pesanan['status'] == 'Menunggu') { ?>
                    <div class="card card-body text-center">
                        <table class="mb-0"><br>
                            <tbody> 
                                <tr>
                                    <th>
                                        <div class="text-center w-75 m-auto">
                                            <img loading="lazy" src="<? echo $cf['url']; ?>assets/images/pesanan/motorcycle.gif" style="height:200px; width:300px;margin-top: 5px;">
                                        </div><br>
                                        <h6 class="text-dark"><span>Sedang mencari driver...</span></h6>
                                        
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#batalkan">Batalkan</button>
                                        <div class="modal fade" id="batalkan" tabindex="-1">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title">Batalkan Pesanan</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="card">
                                                <div class="card-body">
                                                <form method="POST">
                                                <div class="row mb-3">
                                                  <label for="alasan" class="col-sm-12 col-form-label">Alasan</label>
                                                  <div class="col-sm-12">
                                                    <textarea type="text" name="alasan" id="alasan" class="form-control" required></textarea>
                                                  </div>
                                                </div>
                                                </div></div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                  <button type="submit" name="batal" class="btn btn-danger">Batalkan</button>
                                                </div>
                                              </form>
                                              </div>
                                            </div>
                                          </div>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
    <? } else if (empty($data_pesanan['id_driver']) AND $data_pesanan['status'] == 'Sibuk') { ?>
                    <div class="card card-body text-center">
                        <table class="mb-0"><br>
                            <tbody> 
                                <tr>
                                    <th>
                                        <div class="text-center w-75 m-auto">
                                            <img loading="lazy" src="<? echo $cf['url']; ?>assets/images/pesanan/x.gif" style="height:200px; width:200px;margin-top: 5px;">
                                        </div><br>
                                        <h6 class="text-dark"><span>Driver sedang sibuk, mohon mencoba beberapa saat lagi...</span></h6>
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
    <? } else if (!empty($data_pesanan['id_driver']) AND $data_pesanan['tipe'] == 'Healing' AND empty($data_pesanan['harga'])) { ?>
                    <div class="card card-body text-center">
                        <table class="mb-0"><br>
                            <tbody> 
                                <tr>
                                    <th>
                                        <div class="text-center w-75 m-auto">
                                            <img loading="lazy" src="<? echo $cf['url']; ?>assets/images/pesanan/quest.gif" style="height:200px; width:200px;margin-top: 5px;">
                                        </div><br>
                                        <h6 class="text-dark"><span>Silahkan negosiasi harga...</span></h6>
                                        
                                        <a href="<? echo $cf['url']; ?>customer/chat?1=<? echo $_GET['1']; ?>" class="btn btn-primary">Lanjutkan Negosiasi</a>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
    <? } else if (!empty($data_pesanan['id_driver']) AND $data_pesanan['tipe'] == 'Makanan' AND empty($data_pesanan['harga_makanan'])) { ?>
                    <div class="card card-body text-center">
                        <table class="mb-0"><br>
                            <tbody> 
                                <tr>
                                    <th>
                                        <div class="text-center w-75 m-auto">
                                            <img loading="lazy" src="<? echo $cf['url']; ?>assets/images/pesanan/quest.gif" style="height:200px; width:200px;margin-top: 5px;">
                                        </div><br>
                                        <h6 class="text-dark"><span>Driver menuju resto dan menunggu makanan dipesan...</span></h6>
                                        
                                        <a href="<? echo $cf['url']; ?>customer/chat?1=<? echo $_GET['1']; ?>" class="btn btn-primary">Chat Driver</a>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
    <? } else if (!empty($data_pesanan['id_driver'])) { ?>
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
                <small>Lokasi Driver</small>
                <iframe loading="lazy" width="100%" height="200" frameborder="0" style="border:0" src="https://maps.google.com/maps?q=<? echo $data_pesanan['latitude_driver']; ?>,<? echo $data_pesanan['longitude_driver']; ?>&z=14&amp;output=embed" allowfullscreen></iframe>
                <? if ($data_pesanan['status'] == 'Diambil') { ?>
                <button class="btn btn-warning">Menunggu Driver menjemput</button>
                <? } else if ($data_pesanan['status'] == 'Disiapkan') { ?>
                <button class="btn btn-warning">Makanan sedang disiapkan</button>
                <? } else if ($data_pesanan['status'] == 'Penjemputan') { ?>
                <? if ($data_pesanan['tipe'] == 'Paket') { ?>
                <button class="btn btn-primary">Driver sedang menjemput paket</button>
                <? } else { ?>
                <button class="btn btn-primary">Driver dalam perjalanan</button>
                <? } ?>
                <? } else if ($data_pesanan['status'] == 'Perjalanan') { ?>
                <? if ($data_pesanan['tipe'] == 'Healing') { ?>
                <button class="btn btn-primary">Sedang healing</button>
                <? } else if ($data_pesanan['tipe'] == 'Makanan') { ?>
                <button class="btn btn-primary">Makanan sedang diantar</button>
                <? } else if ($data_pesanan['tipe'] == 'Berangkat' OR $data_pesanan['tipe'] == 'Pulang' OR $data_pesanan['tipe'] == 'Destinasi Lain') { ?>
                <button class="btn btn-primary">Perjalanan menuju tujuan</button>
                <? } else if ($data_pesanan['tipe'] == 'Paket') { ?>
                <button class="btn btn-primary">Paket menuju penerima</button>
                <? } ?>
                <? } else if ($data_pesanan['status'] == 'Pembayaran') { ?>
                <button class="btn btn-primary">Pembayaran</button>
                <? } else if ($data_pesanan['status'] == 'Selesai') { ?>
                <a href="<? echo $cf['url']; ?>" class="btn btn-success">Selesai</a>
                <a href="<? echo $cf['url']; ?>" class="btn btn-secondary">Halaman Utama</a>
                <? } ?>
                <hr>
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
                <? if (!empty($data_pesanan['patokan']) AND $data_pesanan['tipe'] != 'Paket') { ?>
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
                <? } else if ($data_pesanan['tipe'] == 'Destinasi Lain') { ?>
                <h5><b>Destinasi</b></h5>
                <? if ($data_pesanan['pemberangkatan'] == 1) { ?>
                <p><i>Dari <? echo $data_destinasi['destinasi1']; ?> ke <? echo $data_destinasi['destinasi2']; ?></i></p><hr>
                <? } else if ($data_pesanan['pemberangkatan'] == 2) { ?>
                <p><i>Dari <? echo $data_destinasi['destinasi2']; ?> ke <? echo $data_destinasi['destinasi1']; ?></i></p><hr>
                <? } } else if ($data_pesanan['tipe'] == 'Paket') { ?>
                <h5><b>Pengantaran Paket</b></h5>
                <? if ($data_pesanan['pemberangkatan'] == 1) { ?>
                <p><i>Dari <? echo $data_destinasi['destinasi1']; ?> ke <? echo $data_destinasi['destinasi2']; ?></i></p><hr>
                <? } else if ($data_pesanan['pemberangkatan'] == 2) { ?>
                <p><i>Dari <? echo $data_destinasi['destinasi2']; ?> ke <? echo $data_destinasi['destinasi1']; ?></i></p><hr>
                <? } } ?>
                <h5><b>Harga</b></h5>
                <p><i>Rp<? echo number_format($data_pesanan['harga'],0,',','.'); ?></i></p><hr>
                <? if (!empty($data_pesanan['harga_makanan'])) { ?>
                <h5><b>Harga Makanan</b></h5>
                <p><i>Rp<? echo number_format($data_pesanan['harga_makanan'],0,',','.'); ?></i></p><hr>
                <h5><b>Total Harga</b></h5>
                <p><i>Rp<? echo number_format($data_pesanan['harga']+$data_pesanan['harga_makanan'],0,',','.'); ?></i></p><hr>
                <? } ?>
                <h5><b>Pembayaran</b></h5>
                <p><i><? echo $data_pesanan['pembayaran']; ?></i></p><hr>
                <? if (!empty($data_pesanan['penerima_nama']) AND !empty($data_pesanan['penerima_kontak'])) { 
                $data_kategori = mysqli_fetch_assoc(mysqli_query($op, "SELECT * FROM kategori_paket WHERE status = 'show' AND id = '".$data_pesanan['id_jenis']."'"));
                ?>
                <h5><b>Informasi Paket</b></h5>
                <p>
                <i>Nama : <? echo $data_pesanan['penerima_nama']; ?></i><br>
                <i>Telepon : <? echo $data_pesanan['penerima_kontak']; ?></i><br>
                <i>Jenis : <? echo $data_kategori['nama']; ?></i>
                </p>
                <? if (!empty($data_pesanan['bukti_pickup'])) { ?>
                <img height="150px" width="150px" class="border border-dark" loading="lazy" src="<? echo $data_pesanan['bukti_pickup']; ?>"><br>
                <small>Bukti Pickup</small>
                <? } ?>
                <? if (!empty($data_pesanan['bukti_diterima'])) { ?>
                <br><br>
                <img height="150px" width="150px" class="border border-dark" loading="lazy" src="<? echo $data_pesanan['bukti_diterima']; ?>"><br>
                <small>Bukti Diterima</small>
                <? } ?>
                <hr>
                <? } ?>
                <? if (!empty($data_pesanan['patokan']) AND $data_pesanan['tipe'] == 'Paket') { ?>
                <h5><b>Alamat Penerima</b></h5>
                <p><i><? echo nl2br(str_replace(‘‘, ‘‘, htmlspecialchars($data_pesanan['patokan']))); ?></i></p><hr>
                <? } ?>
                <h5><b>Driver</b></h5>
                <? if (in_array($data_pesanan['status'], array("Diambil","Penjemputan","Perjalanan","Pembayaran"))) { ?>
                <img height="150px" width="150px" class="border border-dark" loading="lazy" src="<? echo $data_driver['driver_face']; ?>"><br><br>
                <p><i>Nama : <? echo $data_driver['nama']; ?></i></p>
                <!--<p><i>Motor : <? echo $data_driver['driver_merk']; ?> <? echo $data_driver['driver_warna']; ?></i></p>-->
                <p><i>Plat : <? echo $data_driver['driver_plat']; ?></i></p>
                <?
                $rate = mysqli_fetch_assoc(mysqli_query($op, "SELECT AVG(nilai) AS total_rating FROM pesanan WHERE id_driver = '".$data_pesanan['id_driver']."' AND nilai IS NOT NULL"));
                if ($rate['total_rating'] !== null) {
                    $rating = number_format($rate['total_rating'], 1);
                } else {
                    $rating = 'Belum Tersedia';
                }
                ?>
                <p><i>Rating : <? echo $rating; ?></i></p>
                <? } ?>
                <div class="d-flex justify-content-center fixed-bottom"><a href="<? echo $cf['url']; ?>customer/chat?1=<? echo $_GET['1']; ?>" class="btn btn-primary" role="button">Chat</a></div>
                <a href="<? echo $cf['url']; ?>customer/chat?1=<? echo $_GET['1']; ?>" class="btn btn-primary">Chat</a><hr>
            </div>
          </div>
        </div>
    <? } ?>
</div>
</main>
<? if ($data_pesanan['status'] == 'Menunggu') { ?>
<script type="text/javascript">
function checkStatus() {
    var urlParams = new URLSearchParams(window.location.search);
    var id = urlParams.get('1');
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "pesanan_status.php?1=" + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            if (response.trim() !== 'Menunggu') {
                location.reload();
            } else {
                setTimeout(checkStatus, 1000);
            }
        }
    };
    xhr.send();
}
checkStatus();
</script>
<? } else if ($data_pesanan['status'] == 'Diambil') { ?>
<script type="text/javascript">
function checkStatus() {
    var urlParams = new URLSearchParams(window.location.search);
    var id = urlParams.get('1');
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "pesanan_status.php?1=" + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            if (response.trim() !== 'Diambil') {
                location.reload();
            } else {
                setTimeout(checkStatus, 1000);
            }
        }
    };
    xhr.send();
}
checkStatus();
</script>
<? } else if ($data_pesanan['status'] == 'Healing' AND empty($data_pesanan['harga'])) { ?>
<script type="text/javascript">
function checkStatus() {
    var urlParams = new URLSearchParams(window.location.search);
    var id = urlParams.get('1');
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "pesanan_kesepakatan.php?1=" + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.harga == 200) {
            var response = xhr.responseText;
            if (response.trim() > 0) {
                location.reload();
            } else {
                setTimeout(checkStatus, 1000);
            }
        }
    };
    xhr.send();
}
checkStatus();
</script>
<? } else if ($data_pesanan['status'] == 'Disiapkan') { ?>
<script type="text/javascript">
function checkStatus() {
    var urlParams = new URLSearchParams(window.location.search);
    var id = urlParams.get('1');
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "pesanan_status.php?1=" + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            if (response.trim() !== 'Disiapkan') {
                location.reload();
            } else {
                setTimeout(checkStatus, 1000);
            }
        }
    };
    xhr.send();
}
checkStatus();
</script>
<? } else if ($data_pesanan['status'] == 'Penjemputan') { ?>
<script type="text/javascript">
function checkStatus() {
    var urlParams = new URLSearchParams(window.location.search);
    var id = urlParams.get('1');
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "pesanan_status.php?1=" + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            if (response.trim() !== 'Penjemputan') {
                location.reload();
            } else {
                setTimeout(checkStatus, 1000);
            }
        }
    };
    xhr.send();
}
checkStatus();
</script>
<? } else if ($data_pesanan['status'] == 'Perjalanan') { ?>
<script type="text/javascript">
function checkStatus() {
    var urlParams = new URLSearchParams(window.location.search);
    var id = urlParams.get('1');
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "pesanan_status.php?1=" + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            if (response.trim() !== 'Perjalanan') {
                location.reload();
            } else {
                setTimeout(checkStatus, 1000);
            }
        }
    };
    xhr.send();
}
checkStatus();
</script>
<? } else if ($data_pesanan['status'] == 'Pembayaran') { ?>
<script type="text/javascript">
function checkStatus() {
    var urlParams = new URLSearchParams(window.location.search);
    var id = urlParams.get('1');
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "pesanan_status.php?1=" + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            if (response.trim() !== 'Pembayaran') {
                location.reload();
            } else {
                setTimeout(checkStatus, 1000);
            }
        }
    };
    xhr.send();
}
checkStatus();
</script>
<? } include '../library/footer.php'; ?>