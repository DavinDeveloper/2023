<?php
// check request

// include Database connection file
require_once '../../config.php';
date_default_timezone_set('Asia/Jakarta');

$department = $_POST['datadp'];
$currentDate = date("d-m-Y"); // Change format to match MySQL date format
$blnk = "-";

if (empty($department)) {
    echo json_encode(array('success' => false, 'error' => 'No department data provided'));
} else {
    try {
        $sql = "INSERT INTO department (nama_department, date_created, date_updated) 
        VALUES (:department, :currentDate, :updateDate)";
        $stmt = $db->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':department', $department);
        $stmt->bindParam(':currentDate', $currentDate);
        $stmt->bindParam(':updateDate', $blnk);

        $stmt->execute();
        
        echo json_encode(array('success' => true));

    } catch(PDOException $e) {
        echo json_encode(array('success' => false, 'error' => 'ERROR: ' . $e->getMessage()));
    }
}
?>


