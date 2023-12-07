<?php
// check request

// include Database connection file
require_once '../../config.php';
date_default_timezone_set('Asia/Jakarta');

$data_subjecttiket = $_POST['subject'];
$data_status = 'Pending';
$data_unit = $_POST['data_unit'];
$data_topic = $_POST['data_topic'];
$data_priority = $_POST['data_priority'];
$data_duedatetiket = $_POST['data_duedatetiket'];
$newDateDue = date("d-m-Y", strtotime($data_duedatetiket));
$data_threadtiket = $_POST['data_threadtiket'];
$data_userId = $_POST['userId'];
$currentDate = date("d-m-Y h:i a"); // Change format to match MySQL date format
$assign = 0;
$blnkdate = '-';
$blnk = '';
if (empty($data_subjecttiket && $data_threadtiket)) {
    echo json_encode(array('success' => false, 'error' => 'Data Tidak Boleh Kosong'));
} else {
    try {
        //user
        $sqlusers = "SELECT name, email, department FROM users WHERE id = $data_userId";
        $stmtusers = $db->prepare($sqlusers);
        $stmtusers->execute();

        $rowusers = $stmtusers->fetch(PDO::FETCH_ASSOC);

        $n_users = $rowusers['name'];
        $n_email = $rowusers['email'];
        $n_department = $rowusers['department'];
        
        //unit
        $sqlunit = "SELECT singkatan_unit FROM unit WHERE id_unit = $data_unit";
        $stmtunit = $db->prepare($sqlunit);
        $stmtunit->execute();

        $rowunit = $stmtunit->fetch(PDO::FETCH_ASSOC);

        $n_unit = $rowunit['singkatan_unit'];

        //topic
        $sqltopic = "SELECT nama_topic FROM topic WHERE id_topic = $data_topic";
        $stmttopic = $db->prepare($sqltopic);
        $stmttopic->execute();

        $rowtopic = $stmttopic->fetch(PDO::FETCH_ASSOC);

        $n_topic = $rowtopic['nama_topic'];
        
        $sql = "INSERT INTO tiket (t_subject, t_status, t_users, t_email, t_unit, t_topic, 
        t_priority, t_department, t_assigned, t_created_date, t_due_date, t_update_date, t_thread, t_reply_thread,
        n_users, n_email, n_unit, n_topic, n_department, n_assigned)
        VALUES (:t_subject, :t_status, :t_users, :t_email, :t_unit, :t_topic, 
        :t_priority, :t_department, :t_assigned, :t_created_date, :t_due_date, :t_update_date, :t_thread, :t_reply_thread,
        :n_users, :n_email, :n_unit, :n_topic, :n_department, :n_assigned)";
        $stmt = $db->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':t_subject', $data_subjecttiket);
        $stmt->bindParam(':t_status', $data_status);
        $stmt->bindParam(':t_users', $data_userId);
        $stmt->bindParam(':t_email', $data_userId);
        $stmt->bindParam(':t_unit', $data_unit);
        $stmt->bindParam(':t_topic', $data_topic);
        $stmt->bindParam(':t_priority', $data_priority);
        $stmt->bindParam(':t_department', $data_userId);
        $stmt->bindParam(':t_assigned', $assign);
        $stmt->bindParam(':t_created_date', $currentDate);
        $stmt->bindParam(':t_due_date', $newDateDue);
        $stmt->bindParam(':t_update_date', $blnkdate);
        $stmt->bindParam(':t_thread', $data_threadtiket);
        $stmt->bindParam(':t_reply_thread', $blnk);

        $stmt->bindParam(':n_users', $n_users);
        $stmt->bindParam(':n_email', $n_email);
        $stmt->bindParam(':n_unit', $n_unit);
        $stmt->bindParam(':n_topic', $n_topic);
        $stmt->bindParam(':n_department', $n_department);

        $stmt->bindParam(':n_assigned', $blnk);
        

        $stmt->execute();
        
        echo json_encode(array('success' => true));

    } catch(PDOException $e) {
        echo json_encode(array('success' => false, 'error' => 'ERROR: ' . $e->getMessage()));
    }
}
?>


