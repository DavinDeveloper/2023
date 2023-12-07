<?
$pl = 'Customer';
$ps = TRUE;
include '../library/configuration.php';
$check_pesanan = mysqli_query($op, "SELECT * FROM pesanan WHERE id = '".$_GET['1']."'");
if (mysqli_num_rows($check_pesanan) > 0) {
    $data_pesanan = mysqli_fetch_assoc($check_pesanan);
    if ($data_pesanan['id_user'] != $data_user['id']) {
        header("Location: ".$cf['url']);
    }
} else {
    header("Location: ".$cf['url']);
}
if (isset($_POST['kirim'])) {
    $post_pesan = $op->real_escape_string(trim(filter($_POST['pesan'])));
    mysqli_query($op, "INSERT INTO riwayat_chat (id_pesanan,id_user,pesan) VALUES ('".$data_pesanan['id']."', '".$data_user['id']."', '$post_pesan')");
    header("Location: ".$cf['url']."customer/chat?1=".$_GET['1']);
}
$css .= '
<link rel="stylesheet" href="'.$cf['url'].'assets/css/room.css">';
include '../library/header.php';
?>

<main id="main" class="main">
<div class="row">
    <? if (in_array($data_pesanan['status'], array("Diambil","Penjemputan","Perjalanan","Pembayaran"))) { ?>
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3"><br>Chat</h4>
                                        <hr>
                                        <div class="chat-conversation">
                                            <div data-simplebar style="height: 400px; overflow: auto;"> 
                                                <ul class="conversation-list">
                                                    <?
                                                    $check_chat = mysqli_query($op, "SELECT * FROM riwayat_chat,users WHERE riwayat_chat.id_user = users.id AND riwayat_chat.id_pesanan = '".$data_pesanan['id']."' ORDER BY riwayat_chat.id ASC");
                                                    if(mysqli_num_rows($check_chat) == 0) { ?>
                                                    <pre>Obrolan masih kosong...</pre>
                                                    <? } else {
                                                    while ($data_chat = mysqli_fetch_assoc ($check_chat)) {
                                                    if ($data_chat['id_user'] == $data_user['id']) {
		                                                $msg_ood = "odd";
	                                                } else {
		                                                $msg_ood = "";
	                                                }
                                                ?>
                                                    <li class="clearfix <? echo $msg_ood; ?>">
                                                        <div class="conversation-text">
                                                            <div class="ctext-wrap">
                                                                <p>
                                                                    <? echo nl2br(str_replace(‘‘, ‘‘, htmlspecialchars(stripslashes($data_chat['pesan'])))); ?>
                                                                </p>
                                                                <p align="right text-right text-muted" style="font-size:10px;">
                                                                    <? echo stripslashes($data_chat['created']); ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <? } } ?>
                                                </ul>
                                            </div>
                                            <form id="formMhs" method="POST">
                                                <div class="row">
                                                    <div class="col">
                                                        <textarea type="text" class="form-control chat-input" placeholder="Ketik pesan anda..." id="pesan" name="pesan" style="margin-top:10px;" required></textarea>
                                                    </div>
                                                    <div class="col-auto">
                                                        <input type="submit" name="kirim" class="btn btn-success chat-send btn-block waves-effect waves-light" style="margin-top:8px;" value="Kirim">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    <? } else { ?>
                    <div class="card card-body text-center">
                        <table class="mb-0"><br>
                            <tbody> 
                                <tr>
                                    <th>
                                        <div class="text-center w-75 m-auto">
                                            <img loading="lazy" src="<? echo $cf['url']; ?>assets/images/pesanan/sibuk.gif" style="height:200px; width:200px;margin-top: 5px;">
                                        </div><br>
                                        <h6 class="text-dark"><span>Pesanan telah selesai, anda tidak dapat berbicara dengan driver lagi.</span></h6>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
    <? } ?>
</div>
</main>

<? include '../library/footer.php'; ?>