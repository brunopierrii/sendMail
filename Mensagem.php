<?php 

namespace AppSendMail;

require "./PHPMailer/PHPMailer.php";
require "./PHPMailer/SMTP.php";
require "./PHPMailer/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Mensagem
{

    private $para = null;
    private $assunto = null;
    private $mensagem = null;

    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, ?string $value)
    {
        $this->$attr = $value;
    }

    public function mensagemValida()
    {
        if(empty($this->para) || empty($this->assunto) || empty($this->mensagem))
        {
            return false;

        }else{
            
            if(!self::validaEmail($this->para))
            {
                return [false, 'Email Inválido'];
            }
        }

        return true;
    }

    public static function validaEmail($email)
    {
        return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email);
    }

    public function enviarEmail()
    {

        if(is_array($this->mensagemValida()))
        {
            echo 'Email Inválido';
            return false;
        }

        if($this->mensagemValida())
        {
            // echo 'Mensagem Válida!!! Envio em desenvolvimento, aguarde ....';
            $mail = new PHPMailer(true);
            
            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'user@example.com';                     //SMTP username
                $mail->Password   = 'secret';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            
                //Recipients
                $mail->setFrom('from@example.com', 'Mailer');
                $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
                $mail->addAddress('ellen@example.com');               //Name is optional
                $mail->addReplyTo('info@example.com', 'Information');
                $mail->addCC('cc@example.com');
                $mail->addBCC('bcc@example.com');
            
                //Attachments
                $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Here is the subject';
                $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }


        }else{
            echo 'Mensagem Inválida!!! Preencha os campos corretamente.';
        }


    }

}