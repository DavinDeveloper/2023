<?php
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    require_once '../../config.php';

    // get user id
    $user_id = $_POST['id'];

    // delete User
    $sql = "DELETE FROM department WHERE id_department = $user_id";
    $db->exec($sql);
}
?>