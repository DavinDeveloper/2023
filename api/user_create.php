<?php

require './../connection.php';
header('content-type: application/json');
if(isset($_POST)){
    $db = $capsule->table('users')->where('username', $_POST['username']);
    if($db->count() > 0){
        echo json_encode(['status' => false,'message' => 'Username already exists']);
    }
    else{
        $_POST['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $_POST['date_created'] = date('d-m-Y');
        $_POST['status'] = 1;
        $create = $capsule->table('users')->insert($_POST);
        if($create){
            echo json_encode(['status' => true,'message' => 'User account successfully created']);
        }
        else{
            echo json_encode(['status' => false,'message' => 'User account can not be created']);
        }
    }
}