<?php
// check request

// include Database connection file
require_once '../../config.php';
date_default_timezone_set('Asia/Jakarta');

$datanamaunit = $_POST['datanamaunit'];
$datasingkatanunit = $_POST['datasingkatanunit'];
$currentDate = date("d-m-Y"); // Change format to match MySQL date format
$blnk = "-";

if (empty($datanamaunit) && empty($datasingkatanunit)) {
    echo json_encode(array('success' => false, 'error' => 'No department data provided'));
} else {
    try {
        $sql = "INSERT INTO unit (nama_unit, singkatan_unit, date_created, date_updated) 
        VALUES (:nama_unit, :singkatan_unit, :currentDate, :updateDate)";
        $stmt = $db->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':nama_unit', $datanamaunit);
        $stmt->bindParam(':singkatan_unit', $datasingkatanunit);
        $stmt->bindParam(':currentDate', $currentDate);
        $stmt->bindParam(':updateDate', $blnk);

        $stmt->execute();
        
        echo json_encode(array('success' => true));

    } catch(PDOException $e) {
        echo json_encode(array('success' => false, 'error' => 'ERROR: ' . $e->getMessage()));
    }
}
?>


