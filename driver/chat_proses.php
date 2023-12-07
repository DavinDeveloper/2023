<?
include '../library/configuration.php';

if(isset($_POST['pesan'])) {
    $pesan = $op->real_escape_string(trim(filter($_POST['pesan'])));
    $id_pesanan = $_GET['1'];
    mysqli_query($op, "INSERT INTO riwayat_chat (id_pesanan, id_user, pesan) VALUES ('$id_pesanan', '".$data_user['id']."', '$pesan')");
    // $check_id_customer = mysqli_fetch_assoc(mysqli_query($op, "SELECT id_user FROM pesanan WHERE id = '".$id_pesanan."'"));
    // $id_customer = $check_id_customer['id_user'];
    // $data_customer = mysqli_fetch_assoc(mysqli_query($op, "SELECT telepon FROM users WHERE id = '$id_customer'"));
    // whatsapp($data_customer['telepon'], 'Customer: '.$pesan);
    $response = "Berhasil dikirim.";
    echo $response;
} else {
    echo "Gagal sistem.";
}
?>
