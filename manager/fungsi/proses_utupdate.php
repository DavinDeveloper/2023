<?php
// check request

// include Database connection file
require_once '../../config.php';
date_default_timezone_set('Asia/Jakarta');

$id = $_POST['id'];
$unit = $_POST['unit'];
$sunit = $_POST['sunit'];
$currentDate = date("d-m-Y");

if (empty($id)) {
    echo "no id";
} else {
    try {
        $sql = "UPDATE unit SET nama_unit = :unit, singkatan_unit = :sunit , date_updated = :currentDate WHERE id_unit = :id";
        $stmt = $db->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':unit', $unit);
        $stmt->bindParam(':sunit', $sunit);
        $stmt->bindParam(':currentDate', $currentDate);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        echo json_encode(array('success' => true));
    } catch(PDOException $e) {
        echo json_encode(array('success' => false, 'error' => 'ERROR: ' . $e->getMessage()));
    }
}
?>
