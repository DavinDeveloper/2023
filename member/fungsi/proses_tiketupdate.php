<?php
// check request

// include Database connection file
require_once '../../config.php';
date_default_timezone_set('Asia/Jakarta');

$id = $_POST['id'];
$subject = $_POST['update_subjecttiket'];
$unit = $_POST['update_unit'];
$topic = $_POST['update_topic'];
$priority = $_POST['update_priority'];
$due_update = $_POST['date_dueupdate'];
$newDateDue = date("d-m-Y", strtotime($due_update));
$thread_tiket = $_POST['update_threadtiket'];

$currentDate = date("d-m-Y h:i a");

if (empty($id)) {
    echo "no id";
} else {
    try {
        
        //unit
        $sqlunit = "SELECT singkatan_unit FROM unit WHERE id_unit = $unit";
        $stmtunit = $db->prepare($sqlunit);
        $stmtunit->execute();

        $rowunit = $stmtunit->fetch(PDO::FETCH_ASSOC);

        $n_unit = $rowunit['singkatan_unit'];

        //topic
        $sqltopic = "SELECT nama_topic FROM topic WHERE id_topic = $topic";
        $stmttopic = $db->prepare($sqltopic);
        $stmttopic->execute();

        $rowtopic = $stmttopic->fetch(PDO::FETCH_ASSOC);

        $n_topic = $rowtopic['nama_topic'];

        $sql = "UPDATE tiket SET t_subject = :subject, t_unit = :unit, t_topic = :topic, n_unit = :n_unit, n_topic = :n_topic, t_priority = :priority,
        t_due_date = :due_update, t_thread = :thread_tiket, t_update_date = :update_date WHERE id_tiket = :id";
        $stmt = $db->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':unit', $unit);
        $stmt->bindParam(':topic', $topic);
        $stmt->bindParam(':priority', $priority);
        $stmt->bindParam(':due_update', $newDateDue);
        $stmt->bindParam(':thread_tiket', $thread_tiket);
        $stmt->bindParam(':update_date', $currentDate);

        $stmt->bindParam(':n_unit', $n_unit);
        $stmt->bindParam(':n_topic', $n_topic);

        $stmt->bindParam(':id', $id);

        $stmt->execute();
        echo json_encode(array('success' => true));
    } catch(PDOException $e) {
        echo json_encode(array('success' => false, 'error' => 'ERROR: ' . $e->getMessage()));
    }
}
?>
