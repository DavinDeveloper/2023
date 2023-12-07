<?php
// check request

// include Database connection file
require_once '../../config.php';
date_default_timezone_set('Asia/Jakarta');

$topic = $_POST['datatp'];
$currentDate = date("d-m-Y"); // Change format to match MySQL date format
$blnk = "-";

if (empty($topic)) {
    echo json_encode(array('success' => false, 'error' => 'No department data provided'));
} else {
    try {
        $sql = "INSERT INTO topic (nama_topic, date_created, date_updated) 
        VALUES (:topic, :currentDate, :updateDate)";
        $stmt = $db->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':topic', $topic);
        $stmt->bindParam(':currentDate', $currentDate);
        $stmt->bindParam(':updateDate', $blnk);

        $stmt->execute();
        
        echo json_encode(array('success' => true));

    } catch(PDOException $e) {
        echo json_encode(array('success' => false, 'error' => 'ERROR: ' . $e->getMessage()));
    }
}
?>


