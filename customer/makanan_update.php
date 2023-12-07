<?
include '../library/configuration.php';
if (isset($_POST['restoran']) && !empty($_POST['restoran'])) {
    $restoran_id = $_POST['restoran'];
    $result_destinasi = mysqli_query($op, "SELECT destinasi_restoran.harga,destinasi_kampus.destinasi,destinasi_restoran.id FROM destinasi_restoran,destinasi_kampus WHERE destinasi_restoran.id_destinasi = destinasi_kampus.id AND destinasi_restoran.status = 'show' AND destinasi_restoran.id_restoran = '$restoran_id' ORDER BY destinasi_kampus.destinasi ASC");
    ?>
    <option value="">Pilih salah satu...</option>
    <?
    while ($data_destinasi = mysqli_fetch_assoc($result_destinasi)) {
        $options .= '<option value="' . $data_destinasi['id'] . '">' . $data_destinasi['destinasi'] . ' - Rp' . number_format($data_destinasi['harga'], 0, ',', '.') . '</option>';
    }
    echo $options;
} else {
    echo '<option value="">Pilih restoran terlebih dahulu...</option>';
}