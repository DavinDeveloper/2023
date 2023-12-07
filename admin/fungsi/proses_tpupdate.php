<?php
// check request

// include Database connection file
require_once '../../config.php';
date_default_timezone_set('Asia/Jakarta');

$id = $_POST['id'];
$topic = $_POST['topic'];
$currentDate = date("d-m-Y");

if (empty($id)) {
    echo "no id";
} else {
    try {
        $sql = "UPDATE topic SET nama_topic = :topic, date_updated = :currentDate WHERE id_topic = :id";
        $stmt = $db->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':topic', $topic);
        $stmt->bindParam(':currentDate', $currentDate);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        echo json_encode(array('success' => true));
    } catch(PDOException $e) {
        echo json_encode(array('success' => false, 'error' => 'ERROR: ' . $e->getMessage()));
    }
}
?>
