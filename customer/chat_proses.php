<?
include '../library/configuration.php';

if(isset($_POST['pesan'])) {
    $pesan = $op->real_escape_string(trim(filter($_POST['pesan'])));
    $id_pesanan = $_GET['1'];
    mysqli_query($op, "INSERT INTO riwayat_chat (id_pesanan, id_user, pesan) VALUES ('$id_pesanan', '".$data_user['id']."', '$pesan')");
    // $check_id_driver = mysqli_fetch_assoc(mysqli_query($op, "SELECT id_driver FROM pesanan WHERE id = '".$id_pesanan."'"));
    // $id_driver = $check_id_driver['id_driver'];
    // $data_driver = mysqli_fetch_assoc(mysqli_query($op, "SELECT telepon FROM users WHERE id = '$id_driver'"));
    // whatsapp($data_driver['telepon'], 'Customer: '.$pesan);
    $response = "Berhasil dikirim.";
    echo $response;
} else {
    echo "Gagal sistem.";
}
?>
