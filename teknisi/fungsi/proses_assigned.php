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

        if ($status == 'Process') {
            $sqlStartDate = "SELECT t_created_date FROM tiket WHERE id_tiket = :id";
            $stmtStartDate = $db->prepare($sqlStartDate);
            $stmtStartDate->bindParam(':id', $id);
            $stmtStartDate->execute();
            $createdDate = $stmtStartDate->fetchColumn();

            $createdDateTime = DateTime::createFromFormat('d-m-Y h:i a', $createdDate);
            $currentDateTime = DateTime::createFromFormat('d-m-Y h:i a', $currentDate);
            $interval = $currentDateTime->diff($createdDateTime);

            if ($interval->i <= 5) { 
                $sqlUpdatePoin = "UPDATE tiket SET n_poin = n_poin+1 WHERE id_tiket = :id";
                $sqlInsertEval = "INSERT INTO evaluasi (id_user, id_tiket, minus, plus) VALUES (:id_teknisi, :id, 0, 1)";
            } else {
                $sqlUpdatePoin = "UPDATE tiket SET n_poin = n_poin-1 WHERE id_tiket = :id";
                $sqlInsertEval = "INSERT INTO evaluasi (id_user, id_tiket, minus, plus) VALUES (:id_teknisi, :id, 1, 0)";
            }
            $stmtInsertEval = $db->prepare($sqlInsertEval);
            $stmtInsertEval->bindParam(':id_teknisi', $id_teknisi);
            $stmtInsertEval->bindParam(':id', $id);
            $stmtInsertEval->execute();

            $stmtUpdatePoin = $db->prepare($sqlUpdatePoin);
            $stmtUpdatePoin->bindParam(':id', $id);
            $stmtUpdatePoin->execute();
        } else if ($status == 'Closed') {
            $sqlStartDate = "SELECT t_date_start FROM tiket WHERE id_tiket = :id";
            $stmtStartDate = $db->prepare($sqlStartDate);
            $stmtStartDate->bindParam(':id', $id);
            $stmtStartDate->execute();
            $startDate = $stmtStartDate->fetchColumn();

            $startDateTime = DateTime::createFromFormat('d-m-Y h:i a', $startDate);
            $currentDateTime = DateTime::createFromFormat('d-m-Y h:i a', $currentDate);
            $interval = $startDateTime->diff($currentDateTime);
            $intervalMinutes = $interval->i + $interval->h * 60;

            if ($intervalMinutes < 30) {
                $sqlUpdatePoin = "UPDATE tiket SET n_poin = n_poin+2 WHERE id_tiket = :id";
                $sqlInsertEval = "INSERT INTO evaluasi (id_user, id_tiket, minus, plus) VALUES (:id_teknisi, :id, 0, 2)";
            } elseif ($intervalMinutes >= 30 && $intervalMinutes < 60) {
                $sqlUpdatePoin = "UPDATE tiket SET n_poin = n_poin+1 WHERE id_tiket = :id";
                $sqlInsertEval = "INSERT INTO evaluasi (id_user, id_tiket, minus, plus) VALUES (:id_teknisi, :id, 0, 1)";
            } else {
                $sqlUpdatePoin = "UPDATE tiket SET n_poin = n_poin+0 WHERE id_tiket = :id";
                $sqlInsertEval = "INSERT INTO evaluasi (id_user, id_tiket, minus, plus) VALUES (:id_teknisi, :id, 0, 0)";
            }
            $stmtInsertEval = $db->prepare($sqlInsertEval);
            $stmtInsertEval->bindParam(':id_teknisi', $id_teknisi);
            $stmtInsertEval->bindParam(':id', $id);
            $stmtInsertEval->execute();
            

            $stmtUpdatePoin = $db->prepare($sqlUpdatePoin);
            $stmtUpdatePoin->bindParam(':id', $id);
            $stmtUpdatePoin->execute();
        }

        $stmt->execute();
        echo json_encode(array('success' => true));
    } catch(PDOException $e) {
        echo json_encode(array('success' => false, 'error' => 'ERROR: ' . $e->getMessage()));
    }
}
?>
