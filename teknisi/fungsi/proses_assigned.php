<?php
// check request

// include Database connection file
session_start();
require_once '../../config.php';
date_default_timezone_set('Asia/Jakarta');

$id = $_POST['id'];
$id_teknisi = $_SESSION['user']['id'];
$status = $_POST['update_status'];
$reply_thread = $_POST['reply_thread'];
$currentDate = date("d-m-Y h:i a");

if (empty($id)) {
    echo "no id";
} else {
    try {
        // Corrected SQL query to select 'nama_assigned'
        $sqlassigned = "SELECT name FROM users WHERE id = $id_teknisi";
        $stmtass = $db->prepare($sqlassigned);

        // Execute the query and fetch the 'nama_assigned' value
        $stmtass->execute();
        $nama_assigned = $stmtass->fetchColumn();

        $sql = "UPDATE tiket SET t_assigned = :assigned,t_reply_thread = :reply_thread, n_assigned = :nama_assigned, t_status = :status, t_update_date = :update_date WHERE id_tiket = :id";
        $stmt = $db->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':assigned', $id_teknisi);
        $stmt->bindParam(':reply_thread', $reply_thread);
        $stmt->bindParam(':nama_assigned', $nama_assigned);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':update_date', $currentDate);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        echo json_encode(array('success' => true));
    } catch(PDOException $e) {
        echo json_encode(array('success' => false, 'error' => 'ERROR: ' . $e->getMessage()));
    }
}
?>
