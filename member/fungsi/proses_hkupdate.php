<?php
// check request

// include Database connection file
require_once '../../config.php';

$id = $_POST['id'];
$department = $_POST['department'];
$level = $_POST['level'];
$status = $_POST['status'];

if (empty($id)) {
    echo "no id";
} else {
    try {
        $sql = "UPDATE users SET department = :department, hakakses = :level, status = :status WHERE id = :id";
        $stmt = $db->prepare($sql);
        // Bind parameters
        $stmt->bindParam(':department', $department);
        $stmt->bindParam(':level', $level);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        

        $stmt->execute();
        echo json_encode(array('success' => true));
    } catch(PDOException $e) {
        echo json_encode(array('success' => false, 'error' => 'ERROR: ' . $e->getMessage()));
    }
}
?>
