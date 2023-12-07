<?php
require_once '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST['newPassword'];
    $userId = $_POST['userId'];

    // Hash the new password before storing it
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    try {
        $sql = "UPDATE users SET password = :password WHERE id = :userId";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':userId', $userId);

        $stmt->execute();

        echo json_encode(array('success' => true));
    } catch(PDOException $e) {
        echo json_encode(array('success' => false, 'error' => 'ERROR: ' . $e->getMessage()));
    }
}
?>
