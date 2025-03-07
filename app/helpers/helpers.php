<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// SEND EMAIL FUNCTION USING PHPMAILER LIBRARY

IF(!function_exists('sendEMail')){
    function sendEmail($mailConfig){
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $email = new PHPMailer(true);
        $email->SMTPDebug = 0;
        $email->isSMTP();
        $email->Host = env('EMAIL_HOST');
        $email->SMTPAuth = true;
        $email->Username = env('EMAIL_USERNAME');
        $email->Password = env('EMAIL_PASSWORD');
        $email->SMTPSecure = env('EMAIL_ENCRYPTION');
        $email->Port = env('EMAIL_PORT');
        $email->setFrom($mailConfig['mail_from_email'], $mailConfig['mail_from_name']);
        $email->addAddress($mailConfig['mail_recipient_email'], $mailConfig['mail_recipient_name']);
        $email->isHTML(true);
        $email->Subject = $mailConfig['mail_subject'];
        $email->Body = $mailConfig['mail_body'];
        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    }
}