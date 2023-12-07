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
        $sql = "UPDATE tiket SET t_subject = :subject, t_unit = :unit , t_topic = :topic, t_priority = :priority,
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

        $stmt->bindParam(':id', $id);

        $stmt->execute();
        echo json_encode(array('success' => true));
    } catch(PDOException $e) {
        echo json_encode(array('success' => false, 'error' => 'ERROR: ' . $e->getMessage()));
    }
}
?>
