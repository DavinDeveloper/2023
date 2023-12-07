<?
$pl = 'Customer';
// $ps = TRUE;
include 'library/configuration.php';
if (isset($_SESSION['user'])) {
    $ua = $_SERVER['HTTP_USER_AGENT'];
    if(preg_match('#Mozilla/4.05 [fr] (Win98; I)#',$ua) || preg_match('/Java1.1.4/si',$ua) || preg_match('/MS FrontPage Express/si',$ua) || preg_match('/HTTrack/si',$ua) || preg_match('/IDentity/si',$ua) || preg_match('/HyperBrowser/si',$ua) || preg_match('/Lynx/si',$ua)) 
    {
    header('Location:http://shafou.com');
    die();
    }
if (($data_user['upload'] == 'Nothing' OR $data_user['upload'] == 'Rejected' OR $data_user['upload'] == 'Pending' OR $data_user['status'] == 'Pending') AND $data_user['level'] == 'Customer') {
    header("Location: ".$cf['url']."customer/upload");
} else if (!empty($data_user['pesanan'])) {
    header("Location: ".$cf['url']."customer/pesanan?1=".$data_user['pesanan']);
} else if (!empty($data_user['penilaian'])) {
    header("Location: ".$cf['url']."customer/penilaian?1=".$data_user['penilaian']);
}
} else {
    header("Location: ".$cf['url']."landing");
}
include 'library/header.php';
?>
<main id="main" class="main">
    <? $nol=0; $no=1; $nor=1; $check_iklan = mysqli_query($op, "SELECT * FROM iklan WHERE mulai <= CURDATE() AND selesai >= CURDATE() AND status = 'show'"); if (mysqli_num_rows($check_iklan) > 0) { ?>
    <div class="row">
        <!--<div class="card">-->
        <!--    <div class="card-body">-->
              <br>

              <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <? while($data_iklan = mysqli_fetch_assoc($check_iklan)) { ?>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<? echo $nol++; ?>" <? if ($no++ == 1) { ; ?> class="active" aria-current="true"<? } ?> aria-label="Slide <? echo $nor++; ?>"></button>
                  <? } ?>
                </div>
                <div class="carousel-inner">
                <? $no=1; $check_iklan = mysqli_query($op, "SELECT * FROM iklan WHERE mulai <= CURDATE() AND selesai >= CURDATE() AND status = 'show'"); while($data_iklan = mysqli_fetch_assoc($check_iklan)) { ?>
                  <div class="carousel-item <? if ($no++ == 1) { ; ?>active<? } ?>">
                    <img height="200" src="<? echo $data_iklan['gambar']; ?>" class="d-block w-100" alt="<? echo $data_iklan['judul']; ?>">
                  </div>
                <? } ?>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>

          <!--  </div>-->
          <!--</div>-->
    </div>
    <br><? } ?>
<div class="row">
    
    <? 
    $check_driver = mysqli_query($op, "SELECT * FROM users WHERE level = 'Driver' AND stay = 'On' AND status = 'Active' AND pesanan IS NULL");
    if (mysqli_num_rows($check_driver) > 0) {
    ?>
                    <form class="location" id="kirimLokasi" action="" method="post">
                    <input type="hidden" name="latitude" value="">
                    <input type="hidden" name="longitude" value="">
                    </form>
                    <div class="card card-body text-center">
                        <table class="mb-0"><br>
                            <tbody> 
                                <tr>
                                    <th>
                                        <a href="#" class="text-primary btn-loading" onclick="submitForm('<?php echo $cf['url']; ?>customer/berangkat')">
                                            <div class="text-center w-75 m-auto">
                                                <img loading="lazy" src="<? echo $cf['url']; ?>assets/images/menu/berangkat-kampus.svg" style="height:40px; width:40px;margin-top: 5px;">
                                            </div><br>
                                            <h6 class="text-dark"><span>Berangkat Kampus</span></h6>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="#" class="text-primary btn-loading" onclick="submitForm('<?php echo $cf['url']; ?>customer/pulang')">
                                            <div class="text-center w-75 m-auto">
                                                <img loading="lazy" src="<? echo $cf['url']; ?>assets/images/menu/pulang-kampus.svg" style="height:40px; width:40px;margin-top: 5px;">
                                            </div><br>
                                            <h6 class="text-dark"><span>Pulang Kampus</span></h6>
                                        </a>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <a href="#" class="text-primary btn-loading" onclick="submitForm('<?php echo $cf['url']; ?>customer/healing')">
                                            <div class="text-center w-75 m-auto">
                                                <img loading="lazy" src="<? echo $cf['url']; ?>assets/images/menu/healing.svg" style="height:40px; width:40px;margin-top: 5px;">
                                            </div><br>
                                            <h6 class="text-dark"><span>Healing</span></h6>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="#" class="text-primary btn-loading" onclick="submitForm('<?php echo $cf['url']; ?>customer/destinasi_lain')">
                                            <div class="text-center w-75 m-auto">
                                                <img loading="lazy" src="<? echo $cf['url']; ?>assets/images/menu/destinasi-lain.svg" style="height:40px; width:40px;margin-top: 5px;">
                                            </div><br>
                                            <h6 class="text-dark"><span>Destinasi Lain</span></h6>
                                        </a>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <a href="#" class="text-primary btn-loading" onclick="submitForm('<?php echo $cf['url']; ?>customer/paket')">
                                            <div class="text-center w-75 m-auto">
                                                <img loading="lazy" src="<? echo $cf['url']; ?>assets/images/menu/paket.svg" style="height:40px; width:40px;margin-top: 5px;">
                                            </div><br>
                                            <h6 class="text-dark"><span>Paket</span></h6>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="#" class="text-primary btn-loading" onclick="submitForm('<?php echo $cf['url']; ?>customer/makanan')">
                                            <div class="text-center w-75 m-auto">
                                                <img loading="lazy" src="<? echo $cf['url']; ?>assets/images/menu/makanan.svg" style="height:40px; width:40px;margin-top: 5px;">
                                            </div><br>
                                            <h6 class="text-dark"><span>Makanan</span></h6>
                                        </a>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <a href="#" class="text-primary btn-loading" data-bs-toggle="modal" data-bs-target="#soon">
                                            <div class="text-center w-75 m-auto">
                                                <img loading="lazy" src="<? echo $cf['url']; ?>assets/images/menu/intel.svg" style="height:40px; width:40px;margin-top: 5px;">
                                            </div><br>
                                            <h6 class="text-dark"><span>Intel</span></h6>
                                        </a>
                                    </th>
                                </tr>
                                <div class="modal fade" id="soon" tabindex="-1">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title">Coming Soon</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            </tbody>
                        </table>
                    </div>
    <? } else { ?>
    <div class="card card-body text-center">
                        <table class="mb-0"><br>
                            <tbody> 
                                <tr>
                                    <th>
                                            <div class="text-center w-75 m-auto">
                                                <img loading="lazy" src="<? echo $cf['url']; ?>assets/images/menu/driver-tidak-tersedia.svg" style="height:40px; width:40px;margin-top: 5px;">
                                            </div><br>
                                            <h6 class="text-dark"><span>Sedang tidak ada driver yang tersedia...</span></h6>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
    <? } ?>
</div>
</main>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<? if (mysqli_num_rows($check_driver) == 0) { ?>
<script>
        $(document).ready(function () {
            function checkDriverStay() {
                $.ajax({
                    url: 'driver/stay.php',
                    type: 'GET',
                    success: function (data) {
                        var driverStay = parseInt(data);
                        if (driverStay > 0) {
                            location.reload();
                        }
                    },
                    complete: function () {
                        setTimeout(checkDriverStay, 1000);
                    }
                });
            }
            checkDriverStay();
        });
</script>
<? } else if (mysqli_num_rows($check_driver) > 0) { ?>
<script>
        $(document).ready(function () {
            function checkDriverStay() {
                $.ajax({
                    url: 'driver/stay.php',
                    type: 'GET',
                    success: function (data) {
                        var driverStay = parseInt(data);
                        if (driverStay == 0) {
                            location.reload();
                        }
                    },
                    complete: function () {
                        setTimeout(checkDriverStay, 1000);
                    }
                });
            }
            checkDriverStay();
        });
</script>
<? } ?> 
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
include 'library/footer.php'; ?>