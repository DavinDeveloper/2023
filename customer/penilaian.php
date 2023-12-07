<?
$pl = 'Customer';
$ps = TRUE;
include '../library/configuration.php';
$css .= '
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="'.$cf['url'].'assets/css/rating.css">';
$check_pesanan = mysqli_query($op, "SELECT * FROM pesanan WHERE id = '".$_GET['1']."'");
if (mysqli_num_rows($check_pesanan) > 0) {
    $data_pesanan = mysqli_fetch_assoc($check_pesanan);
    if (isset($_POST['rate'])) {
        $post_nilai = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['nilai'],ENT_QUOTES)))));
        $post_masukan = $op->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($_POST['masukan'],ENT_QUOTES)))));
        mysqli_query($op, "UPDATE pesanan SET nilai = '$post_nilai', masukan = '$post_masukan' WHERE id = '".$_GET['1']."'");
        mysqli_query($op, "UPDATE users SET penilaian = NULL WHERE id = '".$data_user['id']."'");
        $insert = mysqli_query($op, "INSERT INTO riwayat_penilaian (id_user,id_pesanan,nilai,masukan) VALUES ('".$data_user['id']."', '".$_GET['1']."', '$post_nilai', '$post_masukan')");
        if ($insert == TRUE) {
            echo '<script>alert("Terima kasih atas penilaian anda.");window.location.href="'.$cf['url'].'";</script>';
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
                <form method="POST">
                    <div class="card card-body text-center">
                        <table class="mb-0"><br>
                            <tbody> 
                                <tr>
                                    <th>
                                        <h6 class="text-dark"><span>Bagaimana Perjalanan anda?</span></h6>
                                        <div class="selectgroup w-100">
                                           <fieldset class="rating">
                                               <input type="radio" id="nilai5" id="nilai" name="nilai" value="5" /><label class = "full" for="nilai5" title="Awesome - 5 stars" required></label>
                                               <input type="radio" id="nilai4" id="nilai" name="nilai" value="4" /><label class = "full" for="nilai4" title="Pretty good - 4 stars" required></label>
                                               <input type="radio" id="nilai3" id="nilai" name="nilai" value="3" /><label class = "full" for="nilai3" title="Meh - 3 stars" required></label>
                                               <input type="radio" id="nilai2" id="nilai" name="nilai" value="2" /><label class = "full" for="nilai2" title="Kinda bad - 2 stars" required></label>
                                               <input type="radio" id="nilai1" id="nilai" name="nilai" value="1" /><label class = "full" for="nilai1" title="Sucks big time - 1 star" required></label>
                                           </fieldset>
                                        </div>
                                        <br><br>
                                        <div class="form-group">
                                            <label class="form-label" for="masukan">Masukan</label>
                                            <textarea class="form-control" id="masukan" name="masukan" rows="5" placeholder="Masukan Feedback anda"></textarea>
                                        </div><br>
                                        <button type="submit" name="rate" class="btn btn-success">Nilai</button>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
</div>
</main>
<? include '../library/footer.php'; ?>