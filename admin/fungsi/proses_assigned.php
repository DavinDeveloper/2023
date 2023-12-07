<?php
use library\Whatsapp;
// check request
session_start();
// include Database connection file
require_once '../../config.php';
require_once '../../connection.php';
require_once '../../library/Whatsapp.php';

date_default_timezone_set('Asia/Jakarta');

$id = $_POST['id'];
$id_teknisi = $_POST['id_assigned'];
$status = $_POST['update_status'];
$currentDate = date("d-m-Y h:i a");

$data = $capsule->table('users')->where('id',$id_teknisi)->first();
$ticket = $capsule->table('tiket')->where('id_tiket',$id)->first();
$user_create_ticket = $capsule->table('users')->where('id',$ticket->t_users)->first();
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

        $sql = "UPDATE tiket SET t_assigned = :assigned, n_assigned = :nama_assigned, t_status = :status, t_update_date = :update_date WHERE id_tiket = :id";
        $stmt = $db->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':assigned', $id_teknisi);
        $stmt->bindParam(':nama_assigned', $nama_assigned);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':update_date', $currentDate);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $whatsapp = new Whatsapp();
        $message = "_Anda memiliki tiket baru dari *$user_create_ticket->name*_\r\n\r\nSubject: $ticket->t_subject\r\nThread: $ticket->t_thread\r\nTopic: $ticket->n_topic\r\nStatus:$ticket->t_status\r\n\r\n _Mohon untuk segera ditindak lanjuti._";
        $whatsapp->sendSingle($data->number_phone,'62',$message);

        echo json_encode(array('success' => true));
    } catch(PDOException $e) {
        echo json_encode(array('success' => false, 'error' => 'ERROR: ' . $e->getMessage()));
    }
}
?>
