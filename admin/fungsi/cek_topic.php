<?php
// check request

    // include Database connection file
    require_once '../../config.php';

    $id = $_POST['id'];
    if (empty($id)) {
        echo "no id";
    }
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
        $stmt = $db->prepare('SELECT * FROM topic WHERE id_topic = :id');
        $stmt->execute(array('id' => $id));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode( $result );
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
?>