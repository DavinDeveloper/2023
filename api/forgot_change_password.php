<?php
require './../connection.php';
$host = $_SERVER['HTTP_HOST'];

if(isset($_POST['password']) && isset($_POST['token'])){
    $checkToken = $capsule->table('forgot_request_token')->where(['token' => $_POST['token']]);
    if($checkToken->count() > 0){
        $email = $checkToken->first()->email;
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $users = $capsule->table('users')->where(['email' => $email])->update(['password' => $password]);
        if($users){
            header('location:http://'.$host.'/change_pass_success.php');
        }
        else{
            header('location:http://'.$host.'/change_pass_failure.php');
        }
    }
    else{
        echo "forbiden";
    }
}
else{
    echo "forbiden";
}