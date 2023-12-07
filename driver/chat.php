<?
$pl = 'Driver';
$ps = TRUE;
include '../library/configuration.php';
$check_pesanan = mysqli_query($op, "SELECT * FROM pesanan WHERE id = '".$_GET['1']."'");
if (mysqli_num_rows($check_pesanan) > 0) {
    $data_pesanan = mysqli_fetch_assoc($check_pesanan);
    if ($data_pesanan['id_driver'] != $data_user['id']) {
        header("Location: ".$cf['url']);
    }
} else {
    header("Location: ".$cf['url']);
}
$css .= '
<link rel="stylesheet" href="'.$cf['url'].'assets/css/room.css">
<script src="https://unpkg.com/simplebar/dist/simplebar.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/simplebar/dist/simplebar.min.css">';
include '../library/header.php';
?>
<audio id="notificationSound" src="chat_notifikasi.mp3" preload="auto"></audio>
<main id="main" class="main">
<div class="row">
    <? if (in_array($data_pesanan['status'], array("Diambil","Penjemputan","Perjalanan","Pembayaran"))) { ?>
                        <? if (empty($data_pesanan['harga']) AND $data_pesanan['tipe'] == 'Healing') { ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">Silahkan membuat kesepakatan harga untuk perjalanan healing bersama customer.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                        <? } ?>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title mb-3"><br>Chat</h4>
                                    <hr>
                                    <div class="chat-conversation">
                                        <div data-simplebar data-simplebar-auto-hide="false" style="height: 300px; overflow: auto;">
                                            <ul class="conversation-list" id="chatList"></ul>
                                        </div>
                                        <form id="chatForm" class="d-flex flex-row align-items-start">
                                            <div class="col">
                                                <textarea type="text" class="form-control chat-input" placeholder="Ketik pesan anda..." id="pesan" name="pesan" rows="1" style="margin-top:10px;" required></textarea>
                                            </div>
                                            <div class="col-auto align-self-end">
                                                <button type="submit" class="btn btn-success chat-send">Kirim</button>
                                            </div>
                                        </form>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <a href="<? echo $cf['url']; ?>customer/pesanan?1=<? echo $_GET['1']; ?>" class="btn btn-danger chat-send btn-block waves-effect waves-light">Kembali ke Pesanan</a>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function loadChat() {
        $.ajax({
            type: "GET",
            url: "chat_loading.php?1=<?php echo $_GET['1']; ?>",
            success: function(response) {
                $("#chatList").html(response);
                updateSimpleBar();
                // playNotificationSound();
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }

    $("#chatForm").on("submit", function(e) {
        e.preventDefault();
        var pesan = $("#pesan").val();

        $.ajax({
            type: "POST",
            url: "chat_proses.php?1=<?php echo $_GET['1']; ?>",
            data: { pesan: pesan },
            success: function(response) {
                console.log(response);

                $("#pesan").val('');
                loadChat();
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    });
    function updateSimpleBar() {
        var simplebarEl = document.querySelector('[data-simplebar]');
        var simplebarInstance = new SimpleBar(simplebarEl);
        simplebarInstance.recalculate();
        simplebarInstance.getScrollElement().scrollTop = simplebarInstance.getScrollElement().scrollHeight;
    }
    // function playNotificationSound() {
    //     if (isNewMessageReceived) {
    //         var notificationSound = document.getElementById("notificationSound");
    //         notificationSound.play();
    //         isNewMessageReceived = false;
    //     }
    // }
    loadChat();
    setInterval(loadChat, 1000);
});
</script>
<? include '../library/footer.php'; ?>