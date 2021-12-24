<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class CorreoElectronicoSender
{
    private $mail;

    public function __construct()
    {
        require_once("../vendor/autoload.php");
        $this->mail = new PHPMailer(true);
        $env = getenv();

        //Server settings
        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $this->mail->isSMTP();                                            //Send using SMTP
        $this->mail->Host       = $env["ZENID_MAIL_HOST"];                     //Set the SMTP server to send through
        $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $this->mail->Username   = $env["ZENID_MAIL_USERNAME"];                     //SMTP username
        $this->mail->Password   = $env["ZENID_MAIL_PASSWORD"];                               //SMTP password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $this->mail->Port       = 465; 
        $this->mail->SMTPDebug  = 0;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    }

    public function enviar($correoElectronico, $asunto, $mensaje)
    {
        $env = getenv();
        $remitente = $env["ZENID_MAIL_USERNAME"];

        try {
             
            //Recipients
            $this->mail->setFrom($remitente, 'ZENID');
            $this->mail->addAddress($correoElectronico, $correoElectronico);

            //Content
            $this->mail->isHTML(true);                                  //Set email format to HTML
            $this->mail->Subject = $asunto;
            $this->mail->Body    = $mensaje;
            $this->mail->AltBody = $mensaje;
            $this->mail->CharSet = 'UTF-8';

            $this->mail->send();
        } catch (Exception $e) {
            echo "Mensaje no se pudo enviar: {$this->mail->ErrorInfo}";
        }
    }
}

?>