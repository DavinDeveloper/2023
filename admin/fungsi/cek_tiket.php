<?php
// check request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // include Database connection file
    require_once '../../config.php';

    $id = $_POST['id'];
    if (empty($id)) {
        echo "no id";
    }else{

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
        $stmt = $db->prepare('SELECT * FROM tiket WHERE id_tiket = :id');
        $stmt->execute(array('id' => $id));
        $fetch = $stmt->fetch(PDO::FETCH_ASSOC);

        $result = array(
            'id_tiket' => $fetch['id_tiket'],
            't_subject' => $fetch['t_subject'],
            't_status' => $fetch['t_status'],
            't_users' => $fetch['t_users'],
            't_email' => $fetch['t_email'],
            't_unit' => $fetch['t_unit'],
            't_topic' => $fetch['t_topic'],
            't_department' => $fetch['t_department'],
            't_assigned' => $fetch['t_assigned'],
            't_priority' => $fetch['t_priority'],

            'n_users' => $fetch['n_users'],
            'n_email' => $fetch['n_email'],
            'n_unit' => $fetch['n_unit'],
            'n_topic' => $fetch['n_topic'],
            'n_department' => $fetch['n_department'],
            'n_assigned' => $fetch['n_assigned'],
            
            't_created_date' => $fetch['t_created_date'],
            't_due_date' => $fetch['t_due_date'],
            't_update_date' => $fetch['t_update_date'],
            't_thread' => $fetch['t_thread'],
            't_reply_thread' => $fetch['t_reply_thread']
        );

        echo json_encode($result);

    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
}
?>
