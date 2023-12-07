<?
$pl = 'Driver';
$ps = TRUE;
include '../library/configuration.php';
$check_pesanan = mysqli_query($op, "SELECT * FROM pesanan WHERE id = '".$_GET['1']."'");
if (mysqli_num_rows($check_pesanan) > 0) {
    $data_pesanan = mysqli_fetch_assoc($check_pesanan);
    $data_customer = mysqli_fetch_assoc(mysqli_query($op, "SELECT nama FROM users WHERE id = '".$data_pesanan['id_user']."'"));
    if (!empty($data_pesanan['id_destinasi_kampus'])) {
        $data_destinasi = mysqli_fetch_assoc(mysqli_query($op, "SELECT destinasi FROM destinasi_kampus WHERE id = '".$data_pesanan['id_destinasi_kampus']."'"));
    } else if (!empty($data_pesanan['id_destinasi_lain'])) {
        $data_destinasi = mysqli_fetch_assoc(mysqli_query($op, "SELECT destinasi1,destinasi2 FROM destinasi_lain WHERE id = '".$data_pesanan['id_destinasi_lain']."'"));
    } else if (!empty($data_pesanan['id_destinasi_restoran'])) {
        $data_destinasi_restoran = mysqli_fetch_assoc(mysqli_query($op, "SELECT * FROM destinasi_restoran WHERE id = '".$data_pesanan['id_destinasi_restoran']."'"));
        $data_restoran = mysqli_fetch_assoc(mysqli_query($op, "SELECT * FROM restoran WHERE id = '".$data_destinasi_restoran['id_restoran']."'"));
        $data_destinasi = mysqli_fetch_assoc(mysqli_query($op, "SELECT destinasi FROM destinasi_kampus WHERE id = '".$data_destinasi_restoran['id_destinasi']."'"));
    }
    $saldo_dibutuhkan = $data_pesanan['harga']/10;
if ($data_pesanan['tipe'] == 'Healing') {
    if (isset($_POST['batal'])) {
        $post_alasan = $op->real_escape_string(strtoupper(trim(stripslashes(strip_tags(htmlspecialchars($_POST['alasan'],ENT_QUOTES))))));
        if ($data_pesanan['status'] == 'Pembayaran' OR $data_pesanan['status'] == 'Selesai') {
            echo '<script>alert("Pesanan tidak bisa dibatalkan.");window.location.href="'.$cf['url'].'";</script>';
        } else {
        mysqli_query($op, "UPDATE pesanan SET status = 'Dibatalkan' WHERE id = '".$_GET['1']."'");
        mysqli_query($op, "UPDATE users SET pesanan = NULL WHERE id = '".$data_user['id']."'");
        mysqli_query($op, "UPDATE users SET pesanan = NULL WHERE id = '".$data_pesanan['id_user']."'");
        $insert = mysqli_query($op, "INSERT INTO riwayat_pembatalan (id_user,id_pesanan,alasan) VALUES ('".$data_user['id']."', '".$_GET['1']."', '$post_alasan')");
        if ($insert == TRUE) {
            echo '<script>alert("Pesanan berhasil dibatalkan.");window.location.href="'.$cf['url'].'";</script>';
        } else {
            echo '<script>alert("Gagal sistem.");window.location.href="'.$cf['url'].'";</script>';
        }
        }
    }
} else if ($data_pesanan['tipe'] == 'Berangkat' OR $data_pesanan['tipe'] == 'Pulang' OR $data_pesanan['tipe'] == 'Destinasi Lain' OR $data_pesanan['tipe'] == 'Paket' OR $data_pesanan['tipe'] == 'Makanan') {
    if (isset($_POST['batal'])) {
        $saldo_kembali = $data_pesanan['harga']/10;
        $saldo_driver = $data_user['saldo']+$saldo_kembali;
        $post_alasan = $op->real_escape_string(strtoupper(trim(stripslashes(strip_tags(htmlspecialchars($_POST['alasan'],ENT_QUOTES))))));
        if ($data_pesanan['status'] == 'Pembayaran' OR $data_pesanan['status'] == 'Selesai') {
            echo '<script>alert("Pesanan tidak bisa dibatalkan.");window.location.href="'.$cf['url'].'";</script>';
        } else {
        mysqli_query($op, "UPDATE pesanan SET status = 'Dibatalkan' WHERE id = '".$_GET['1']."'");
        mysqli_query($op, "UPDATE users SET pesanan = NULL, saldo = '$saldo_driver' WHERE id = '".$data_user['id']."'");
        mysqli_query($op, "UPDATE users SET pesanan = NULL WHERE id = '".$data_pesanan['id_user']."'");
        $insert = mysqli_query($op, "INSERT INTO riwayat_pembatalan (id_user,id_pesanan,alasan) VALUES ('".$data_user['id']."', '".$_GET['1']."', '$post_alasan')");
        if ($insert == TRUE) {
            echo '<script>alert("Pesanan berhasil dibatalkan.");window.location.href="'.$cf['url'].'";</script>';
        } else {
            echo '<script>alert("Gagal sistem.");window.location.href="'.$cf['url'].'";</script>';
        }
        }
    }
}
if ($data_pesanan['tipe'] == 'Healing') {
    if (isset($_POST['deal'])) {
        $post_harga = $op->real_escape_string(strtoupper(trim(stripslashes(strip_tags(htmlspecialchars($_POST['harga'],ENT_QUOTES))))));
        $saldo_dibutuhkan = $post_harga/10;
        $saldo_driver = $data_user['saldo']-$saldo_dibutuhkan;
        $post_alasan = $op->real_escape_string(strtoupper(trim(stripslashes(strip_tags(htmlspecialchars($_POST['alasan'],ENT_QUOTES))))));
        if ($data_user['saldo'] < $saldo_dibutuhkan) {
            echo '<script>alert("Saldo anda kurang dari 10% harga kesepakatan.")</script>';
        } else {
        mysqli_query($op, "UPDATE pesanan SET status = 'Penjemputan', harga = '$post_harga' WHERE id = '".$_GET['1']."'");
        mysqli_query($op, "UPDATE users SET saldo = '$saldo_driver' WHERE id = '".$data_user['id']."'");
        $insert = mysqli_query($op, "INSERT INTO riwayat_pesanan (id_pesanan,proses) VALUES ('".$_GET['1']."', 'Kesepakatan')");
        $insert = mysqli_query($op, "INSERT INTO riwayat_pesanan (id_pesanan,proses) VALUES ('".$_GET['1']."', 'Penjemputan')");
        if ($insert == TRUE) {
            echo '<script>alert("Harga kesepakatan berhasil disetel, ayo jemput customer sekarang.");window.location.href="'.$cf['url'].'";</script>';
        } else {
            echo '<script>alert("Gagal sistem.");window.location.href="'.$cf['url'].'";</script>';
        }
        }
    }
} else if ($data_pesanan['tipe'] == 'Makanan') {
    if (isset($_POST['simpan'])) {
        $post_harga = $op->real_escape_string(strtoupper(trim(stripslashes(strip_tags(htmlspecialchars($_POST['harga'],ENT_QUOTES))))));
        mysqli_query($op, "UPDATE pesanan SET status = 'Disiapkan', harga_makanan = '$post_harga' WHERE id = '".$_GET['1']."'");
        $insert = mysqli_query($op, "INSERT INTO riwayat_pesanan (id_pesanan,proses) VALUES ('".$_GET['1']."', 'Harga Makanan')");
        if ($insert == TRUE) {
            echo '<script>alert("Harga makanan berhasil disetel, ayo antar makanan jika sudah selesai.");window.location.href="'.$cf['url'].'";</script>';
        } else {
            echo '<script>alert("Gagal sistem.");window.location.href="'.$cf['url'].'";</script>';
        }
    }
}
    if (isset($_POST['penjemputan'])) {
        mysqli_query($op, "UPDATE pesanan SET status = 'Penjemputan' WHERE id = '".$_GET['1']."'");
        $insert = mysqli_query($op, "INSERT INTO riwayat_pesanan (id_pesanan,proses) VALUES ('".$_GET['1']."', 'Penjemputan')");
        if ($insert == TRUE) {
            echo '<script>alert("Ayo jemput customer kamu.");window.location.href="'.$cf['url'].'";</script>';
        } else {
            echo '<script>alert("Gagal sistem.");window.location.href="'.$cf['url'].'";</script>';
        }
    } else if (isset($_POST['perjalanan'])) {
        $file = $_FILES['file']['name'];
    	if (!empty($file)) {
        	$upload = "davin-wardana-".random(10)."-".$data_pesanan['id'].".".strtolower(end(explode('.', $file)));
        	$result = $cf['url']."assets/images/paket/".$upload;
        	move_uploaded_file($_FILES['file']['tmp_name'], '../assets/images/paket/'.$upload);
    	    mysqli_query($op, "UPDATE pesanan SET bukti_pickup = '$result' WHERE id = '".$_GET['1']."'");
        }
        mysqli_query($op, "UPDATE pesanan SET status = 'Perjalanan' WHERE id = '".$_GET['1']."'");
        $insert = mysqli_query($op, "INSERT INTO riwayat_pesanan (id_pesanan,proses) VALUES ('".$_GET['1']."', 'Perjalanan')");
        if ($insert == TRUE) {
            if ($data_pesanan['tipe'] == 'Healing') {
                echo '<script>alert("Selamat healing...");window.location.href="'.$cf['url'].'";</script>';
            } else if ($data_pesanan['tipe'] == 'Berangkat' OR $data_pesanan['tipe'] == 'Pulang' OR $data_pesanan['tipe'] == 'Destinasi Lain') {
                echo '<script>alert("Antarkan customer kamu dengan selamat ya.");window.location.href="'.$cf['url'].'";</script>';
            } else if ($data_pesanan['tipe'] == 'Paket') {
                echo '<script>alert("Antarkan paket dengan selamat ya.");window.location.href="'.$cf['url'].'";</script>';
            } else if ($data_pesanan['tipe'] == 'Makanan') {
                echo '<script>alert("Antarkan makanan ke customer ya.");window.location.href="'.$cf['url'].'";</script>';
            }
        } else {
            echo '<script>alert("Gagal sistem.");window.location.href="'.$cf['url'].'";</script>';
        }
    } else if (isset($_POST['pembayaran'])) {
        mysqli_query($op, "UPDATE pesanan SET status = 'Pembayaran' WHERE id = '".$_GET['1']."'");
        $insert = mysqli_query($op, "INSERT INTO riwayat_pesanan (id_pesanan,proses) VALUES ('".$_GET['1']."', 'Pembayaran')");
        if ($insert == TRUE) {
            echo '<script>alert("Pastikan customer telah membayar pesanan.");window.location.href="'.$cf['url'].'";</script>';
        } else {
            echo '<script>alert("Gagal sistem.");window.location.href="'.$cf['url'].'";</script>';
        }
    } else if (isset($_POST['selesai'])) {
        $file = $_FILES['file']['name'];
    	if (!empty($file)) {
        	$upload = "davin-wardana-".random(10)."-".$data_pesanan['id'].".".strtolower(end(explode('.', $file)));
        	$result = $cf['url']."assets/images/paket/".$upload;
        	move_uploaded_file($_FILES['file']['tmp_name'], '../assets/images/paket/'.$upload);
    	    mysqli_query($op, "UPDATE pesanan SET bukti_diterima = '$result' WHERE id = '".$_GET['1']."'");
        }
        mysqli_query($op, "UPDATE pesanan SET status = 'Selesai', end = NOW() WHERE id = '".$_GET['1']."'");
        mysqli_query($op, "UPDATE users SET pesanan = NULL WHERE id = '".$data_user['id']."'");
        mysqli_query($op, "UPDATE users SET pesanan = NULL, penilaian = '".$_GET['1']."' WHERE id = '".$data_pesanan['id_user']."'");
        $insert = mysqli_query($op, "INSERT INTO riwayat_pesanan (id_pesanan,proses) VALUES ('".$_GET['1']."', 'Selesai')");
        if ($insert == TRUE) {
            echo '<script>alert("Yeyy pesanan selesai, kamu bisa narik pesanan lagi.");window.location.href="'.$cf['url'].'";</script>';
        } else {
            echo '<script>alert("Gagal sistem.");window.location.href="'.$cf['url'].'";</script>';
        }
    }
} else {
    header("Location: ".$cf['url']);
}
include '../library/header.php';
?>
<main id="main" class="main">
<div class="row">
    <? if ($data_pesanan['id_driver'] == $data_user['id']) { ?>
        <form method="POST" enctype="multipart/form-data">
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
                <small>Lokasi Customer</small>
                <iframe loading="lazy" width="100%" height="200" frameborder="0" style="border:0" src="https://maps.google.com/maps?q=<? echo $data_pesanan['latitude_customer']; ?>,<? echo $data_pesanan['longitude_customer']; ?>&z=14&amp;output=embed" allowfullscreen></iframe>
                <form method="POST" enctype="multipart/form-data">
                <? if ($data_pesanan['status'] == 'Diambil') { ?>
                
                <? if ($data_pesanan['tipe'] == 'Healing') { ?>
                <p>Status: Menunggu kesepakatan harga</p>
                <label for="harga" class="col-sm-12 col-form-label">Kesepakatan Harga </label>
                <input type="number" name="harga" id="harga" class="form-control" max="<? echo $data_user['saldo']*10; ?>" required><br>
                <button type="submit" name="deal" class="btn btn-primary">Setel kesepakatan harga dan jemput Customer sekarang</button>
                <? } else if ($data_pesanan['tipe'] == 'Makanan') { ?>
                <p>Status: Menuju restoran</p>
                <label for="harga" class="col-sm-12 col-form-label">Masukkan Harga Makanan </label>
                <input type="number" name="harga" id="harga" class="form-control" required><br>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <? } else if ($data_pesanan['tipe'] == 'Berangkat' OR $data_pesanan['tipe'] == 'Pulang' OR $data_pesanan['tipe'] == 'Destinasi Lain') { ?>
                <p>Status: Customer menunggu penjemputan</p>
                <button type="submit" name="penjemputan" class="btn btn-primary">Berangkat jemput Customer</button>
                <? } else if ($data_pesanan['tipe'] == 'Paket') { ?>
                <p>Status: Menunggu paket dijemput</p>
                <button type="submit" name="penjemputan" class="btn btn-primary">Berangkat jemput paket</button>
                <? } ?>
                
                <? } else if ($data_pesanan['status'] == 'Penjemputan' OR $data_pesanan['status'] == 'Disiapkan') { ?>
                <? if ($data_pesanan['status'] == 'Penjemputan') { ?>
                <p>Status: Menunggu driver sampai</p>
                <? } else if ($data_pesanan['status'] == 'Disiapkan') { ?>
                <p>Status: Menunggu makanan siap</p>
                <? } ?>
                <? if ($data_pesanan['tipe'] == 'Healing') { ?>
                <button type="submit" name="perjalanan" class="btn btn-primary">Berangkat healing</button>
                <? } else if ($data_pesanan['tipe'] == 'Berangkat' OR $data_pesanan['tipe'] == 'Pulang' OR $data_pesanan['tipe'] == 'Destinasi Lain') { ?>
                <button type="submit" name="perjalanan" class="btn btn-primary">Berangkat antar Customer</button>
                <? } else if ($data_pesanan['tipe'] == 'Makanan') { ?>
                <button type="submit" name="perjalanan" class="btn btn-primary">Berangkat antar Makanan</button>
                <? } else if ($data_pesanan['tipe'] == 'Paket') { ?>
                <label for="file" class="col-sm-12 col-form-label">Upload Bukti</label>
                <div class="col-sm-12">
                  <input class="form-control" type="file" name="file" id="file" required>
                </div><br>
                <? if ($data_pesanan['pembayaran'] == 'Cashless') { ?>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#pembayaran">Payment</button>
                <div class="modal fade" id="pembayaran" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Metode Pembayaran</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="card">
                        <div class="card-body">
                            <br>
                            <? $check_pembayaran = mysqli_query($op, "SELECT * FROM metode_pembayaran WHERE status = 'show' ORDER BY nama ASC");
                            while($data_pembayaran = mysqli_fetch_assoc($check_pembayaran)) { ?>
                            <h5><b><? echo $data_pembayaran['nama']; ?></b></h5>
                            <? if (!empty($data_pembayaran['nomor'])) {
                            echo $data_pembayaran['nomor'];
                            } ?>
                            <? if (!empty($data_pembayaran['qr'])) { ?>
                            <img src="<? echo $data_pembayaran['qr']; ?>" width="100%" loading="lazy">
                            <? } ?>
                            <p><i><? echo $data_pembayaran['alias']; ?></i></p><hr>
                            <? } ?>
                        </div></div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                <button type="submit" name="perjalanan" class="btn btn-primary">Berangkat antar paket</button>
                <? } } ?>
                
                <? } else if ($data_pesanan['status'] == 'Perjalanan') { ?>
                
                <? if ($data_pesanan['tipe'] == 'Healing') { ?>
                <p>Status: Sedang healing</p>
                <button type="submit" name="pembayaran" class="btn btn-primary">Telah selesai healing</button>
                <? } else if ($data_pesanan['tipe'] == 'Berangkat' OR $data_pesanan['tipe'] == 'Pulang' OR $data_pesanan['tipe'] == 'Destinasi Lain' OR $data_pesanan['tipe'] == 'Paket' OR $data_pesanan['tipe'] == 'Makanan') { ?>
                <p>Status: Sedang dalam pengantaran</p>
                <? if ($data_pesanan['tipe'] == 'Paket') { ?>
                <label for="file" class="col-sm-12 col-form-label">Upload Bukti</label>
                <div class="col-sm-12">
                  <input class="form-control" type="file" name="file" id="file" required>
                </div><br>
                <button type="submit" name="selesai" class="btn btn-primary">Selesai</button>
                <? } else { ?>
                <button type="submit" name="pembayaran" class="btn btn-primary">Telah sampai tujuan</button>
                <? } } ?>
                
                <? } else if ($data_pesanan['status'] == 'Pembayaran') { ?>
                <p>Menunggu pembayaran customer</p>
                <? if ($data_pesanan['pembayaran'] == 'Cashless') { ?>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#pembayaran">Payment</button>
                <div class="modal fade" id="pembayaran" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Metode Pembayaran</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="card">
                        <div class="card-body">
                            <br>
                            <? $check_pembayaran = mysqli_query($op, "SELECT * FROM metode_pembayaran WHERE status = 'show' ORDER BY nama ASC");
                            while($data_pembayaran = mysqli_fetch_assoc($check_pembayaran)) { ?>
                            <h5><b><? echo $data_pembayaran['nama']; ?></b></h5>
                            <? if (!empty($data_pembayaran['nomor'])) {
                            echo $data_pembayaran['nomor'];
                            } ?>
                            <? if (!empty($data_pembayaran['qr'])) { ?>
                            <img src="<? echo $data_pembayaran['qr']; ?>" width="100%" loading="lazy">
                            <? } ?>
                            <p><i><? echo $data_pembayaran['alias']; ?></i></p><hr>
                            <? } ?>
                        </div></div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                <? } ?>
                <button type="submit" name="selesai" class="btn btn-primary">Selesai</button>
                <? } else if ($data_pesanan['status'] == 'Selesai') { ?>
                <button class="btn btn-success">Selesai</button>
                <? } ?>
                </form>
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
                <h5><b>Biaya Admin</b></h5>
                <p><i>Rp<? echo number_format($saldo_dibutuhkan,0,',','.'); ?></i></p><hr>
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
                <h5><b>Customer</b></h5>
                <p><i><? echo $data_customer['nama']; ?></i></p>
                <div class="d-flex justify-content-center fixed-bottom"><a href="<? echo $cf['url']; ?>driver/chat?1=<? echo $_GET['1']; ?>" class="btn btn-primary" role="button">Chat</a></div>
                <a href="<? echo $cf['url']; ?>driver/chat?1=<? echo $_GET['1']; ?>" class="btn btn-primary">Chat</a>
                <? if ($data_pesanan['status'] != 'Pembayaran' AND $data_pesanan['status'] != 'Selesai' AND $data_pesanan['status'] != 'Dibatalkan') { ?>
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
                        <form method="POST" enctype="multipart/form-data">
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
                <? } ?><hr>
            </div>
          </div>
        </div>
        </form>
    <? } ?>
</div>
</main>

<?
include '../library/footer.php'; ?>