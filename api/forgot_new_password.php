<?php
require './../library/Mail.php';
require './../connection.php';

use library\SendMail;

$host = $_SERVER['HTTP_HOST'];
if(isset($_POST['email'])){
     $check = $capsule->table('users')->where('email', $_POST['email']);
     if($check->count() > 0){
        $token = password_hash(uniqid(), PASSWORD_DEFAULT);
        $create = $capsule->table('forgot_request_token')->insert([
         'email' => $_POST['email'],
         'token' => $token,
         'expired' => '1'
        ]);
        $mail = new SendMail();
        $link = "http://".$host."/new_password.php?token=".$token;
        $template = file_get_contents('../template_email/email_forgot_password.php');
        $template = str_replace('{{link}}', $link, $template);
        $mail->from('user@example.com','no-reply')
             ->toAddress('abdulrohim34@gmail.com')
             ->message('Permintaan reset password',$template)
             ->send();
        header('location://'.$host.'/success_forgot_password.php?email='.$_POST['email']);
     }
     else{
        header('location://'.$host.'/not_found.php?email='.$_POST['email']);
     }
}
else{
    echo "Forbiden";
}