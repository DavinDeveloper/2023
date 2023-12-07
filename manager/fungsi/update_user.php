<?php
require_once '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $phonenumber = $_POST['phonenumber'];
    $useremail = $_POST['useremail'];
    $userId = $_POST['userId'];

    try {
        $sql = "UPDATE users SET name = :fullname, number_phone = :phonenumber, email = :useremail WHERE id = :userId";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':phonenumber', $phonenumber);
        $stmt->bindParam(':useremail', $useremail);
        $stmt->bindParam(':userId', $userId);

        $stmt->execute();

        echo json_encode(array('success' => true));
    } catch(PDOException $e) {
        echo json_encode(array('success' => false, 'error' => 'ERROR: ' . $e->getMessage()));
    }
}
?>
