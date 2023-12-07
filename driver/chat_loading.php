<?
include '../library/configuration.php';

$idPesanan = $_GET['1'];
$check_chat = mysqli_query($op, "SELECT * FROM riwayat_chat, users WHERE riwayat_chat.id_user = users.id AND riwayat_chat.id_pesanan = '$idPesanan' ORDER BY riwayat_chat.id ASC");

if(mysqli_num_rows($check_chat) > 0) {
    while ($data_chat = mysqli_fetch_assoc($check_chat)) {
        $msgClass = ($data_chat['id_user'] == $data_user['id']) ? 'odd' : '';

        echo '<li class="clearfix ' . $msgClass . '">';
        echo '<div class="conversation-text">';
        echo '<div class="ctext-wrap">';
        echo '<p>' . nl2br(htmlspecialchars(stripslashes($data_chat['pesan']))) . '</p>';
        echo '<p align="right" class="text-right text-muted" style="font-size:10px;">' . stripslashes($data_chat['created']) . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</li>';
    }
} else {
    echo '<pre>Obrolan masih kosong...</pre>';
}
?>
