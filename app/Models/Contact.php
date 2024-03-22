<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Contact
{
    private $name;
    private $email;
    private $subject;
    private $message;

    public function setData($name, $email, $subject, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
    }

    public function validateForm()
    {
        if (strlen($this->name) < 3)
            return 'Ім\'я занадто коротке';
        elseif (strlen($this->email) < 3 || !strpos($this->email, '.'))
            return 'Email введено невірно';
        elseif (strlen($this->subject) < 3)
            return 'Тема занадто коротка';
        elseif (strlen($this->message) < 10)
            return 'Повідомлення занадто коротке';
        else
            return 'success';
    }

    public function sendMail()
    {
        //Create an instance
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                         //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.ukr.net';                         //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'dante33@ukr.net';                      //SMTP username
            $mail->Password   = 'pPrdDzqdQA8QSp3L';                     //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('dante33@ukr.net');
            $mail->addAddress('dante33@ukr.net');
            $mail->addReplyTo($this->email, $this->name);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $this->subject;
            $mail->Body    = $this->message;
            $mail->CharSet = "UTF-8";

            $mail->send();
            return 'Повідомлення надіслано';
        } catch (Exception $e) {
            return "Повідомлення не було відправлено. Причина: {$mail->ErrorInfo}";
        }
    }
}