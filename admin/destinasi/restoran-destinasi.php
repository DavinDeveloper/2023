<?
include '../../library/configuration.php'; 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["restoran_id"]) && !empty($_POST["restoran_id"])) {
    $restoranId = $_POST["restoran_id"];
    $query = mysqli_query($op, "SELECT * FROM destinasi_kampus WHERE id NOT IN 
               (SELECT id_destinasi FROM destinasi_restoran WHERE id_restoran = '$restoranId' AND status = 'show') AND status = 'show' ORDER BY destinasi ASC");
    $options = '<option value="">Pilih salah satu...</option>';
    while ($row = mysqli_fetch_assoc($query)) {
        $options .= '<option value="' . $row['id'] . '">' . $row['destinasi'] . '</option>';
    }
    echo $options;
} else {
    echo "Terjadi kesalahan.";
}
?>