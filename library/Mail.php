<?php
namespace library;

require './../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class SendMail {

    public $mail;
    public function __construct(){
        $this->mail = new PHPMailer(true);
        $this->mail->SMTPDebug = false;                      //Enable verbose debug output
        $this->mail->isSMTP();                                            //Send using SMTP
        $this->mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $this->mail->Username   = 'dharmagroup.co.id@gmail.com';                     //SMTP username
        $this->mail->Password   = 'vsgccxossdramlsh';                               //SMTP password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $this->mail->Port       = 587;     
    }

    public function from($emailFrom, $nameFrom){
        $this->mail->setFrom($emailFrom, $nameFrom);
        return $this;
    }
    
    public function toAddress($emailTo, $nameTo = null){
        $this->mail->addAddress($emailTo, $nameTo);
        return $this;
    }

    public function withCC($email){
        $this->mail->addCC($email);
        return $this;
    }
    public function withBCC($email){
        $this->mail->addBCC($email);
        return $this;
    }
    public function message($subject, $body, $isHtml = true){
        $this->mail->isHTML($isHtml);                                  //Set email format to HTML
        $this->mail->Subject = $subject;
        $this->mail->Body    = $body;
        return $this;
    }

    public function send(){
        return $this->mail->send();
    }

}