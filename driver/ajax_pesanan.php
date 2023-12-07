<?
include '../library/configuration.php';

$pesananData = array();

$check_pesanan = mysqli_query($op, "SELECT * FROM pesanan WHERE id_driver IS NULL AND status = 'Menunggu'");
while ($data_pesanan = mysqli_fetch_assoc($check_pesanan)) {
    $data_pemesan = mysqli_fetch_assoc(mysqli_query($op, "SELECT nama FROM users WHERE id = '".$data_pesanan['id_user']."'")); 
    $harga_pesanan = 'Rp'.number_format($data_pesanan['harga'],0,',','.');
    if (!empty($data_pesanan['id_destinasi_kampus'])) {
        $data_destinasi = mysqli_fetch_assoc(mysqli_query($op, "SELECT destinasi FROM destinasi_kampus WHERE id = '".$data_pesanan['id_destinasi_kampus']."'"));
        if ($data_pesanan['tipe'] == 'Berangkat') {
            $keterangan = $data_pesanan['tipe'].' ke kampus '.$data_pesanan['kampus'].' dari '.$data_destinasi['destinasi'];
        } else if ($data_pesanan['tipe'] == 'Pulang') {
            $keterangan = $data_pesanan['tipe'].' dari kampus '.$data_pesanan['kampus'].' ke '.$data_destinasi['destinasi'];
        }
    } else if (!empty($data_pesanan['id_destinasi_lain'])) {
        $data_destinasi = mysqli_fetch_assoc(mysqli_query($op, "SELECT destinasi1,destinasi2 FROM destinasi_lain WHERE id = '".$data_pesanan['id_destinasi_lain']."'"));
        if ($data_pesanan['pemberangkatan'] == 1) {
            $keterangan = $data_pesanan['tipe'].' - '.$data_destinasi['destinasi1'].' ke '.$data_destinasi['destinasi2'];
        } else if ($data_pesanan['pemberangkatan'] == 2) {
            $keterangan = $data_pesanan['tipe'].' - '.$data_destinasi['destinasi2'].' ke '.$data_destinasi['destinasi1'];
        }
    } else if (!empty($data_pesanan['id_destinasi_restoran'])) {
        $data_destinasi_restoran = mysqli_fetch_assoc(mysqli_query($op, "SELECT * FROM destinasi_restoran WHERE id = '".$data_pesanan['id_destinasi_restoran']."'"));
        $data_restoran = mysqli_fetch_assoc(mysqli_query($op, "SELECT * FROM restoran WHERE id = '".$data_destinasi_restoran['id_restoran']."'"));
        $data_destinasi = mysqli_fetch_assoc(mysqli_query($op, "SELECT destinasi FROM destinasi_kampus WHERE id = '".$data_destinasi_restoran['id_destinasi']."'"));
        $keterangan = $data_pesanan['tipe'].' - '.$data_restoran['nama'].' ke '.$data_destinasi['destinasi'];
    } else if (!empty($data_pesanan['destinasi_healing'])) {
        $keterangan = $data_pesanan['tipe'].' ke '.$data_pesanan['destinasi_healing'];
    }

    $pesananData[] = array(
        'id' => $data_pesanan['id'],
        'nama' => $data_pemesan['nama'],
        'harga' => $harga_pesanan,
        'keterangan' => $keterangan
    );
}

echo json_encode($pesananData);
?>
