<?
include '../../library/configuration.php';
    $check_pesanan = mysqli_query($op, "SELECT * FROM pesanan WHERE status = 'Menunggu'");
    while($data_pesanan = mysqli_fetch_assoc($check_pesanan)) {
    
    if (date("H:i") > date("H:i:s", strtotime($data_pesanan['time']) + 180)) {
        $update = mysqli_query($op, "UPDATE pesanan SET status = 'Sibuk' WHERE id = '".$data_pesanan['id']."'");
        $update = mysqli_query($op, "UPDATE users SET pesanan = NULL WHERE id = '".$data_pesanan['id_user']."'");
        $data_pemesan = mysqli_fetch_assoc(mysqli_query($op, "SELECT telepon FROM users WHERE id = '".$data_pesanan['id_user']."'"));
        whatsapp($data_pemesan['telepon'], 'Pesanan anda dibatalkan, saat ini driver sedang sibuk atau tidak tersedia, coba dalam beberapa saat lagi.');
    }
        if ($update == TRUE) {
    	    echo "===============<br>Update Pesanan Berhasil<br><br>Id Pesanan : ".$data_pesanan['id']."<br>===============<br>";
        } else {
          echo "Tidak ada.";
        }
    }