<?php
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    require_once '../../config.php';

    // get user id
    $user_id = $_POST['id'];

    // delete User
    $sql = "DELETE FROM kategori WHERE id_kategori = $user_id";
    $db->exec($sql);
}
?>