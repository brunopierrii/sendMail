<?php 

namespace AppSendMail;

require "../PHPMailer/PHPMailer.php";
require "../PHPMailer/SMTP.php";
require "../PHPMailer/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Mensagem
{

    private $para = null;
    private $assunto = null;
    private $mensagem = null;
    public $status = ['codigo_status' => null, 'descricao_status'];

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
                return [];
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
            $this->status = [
                'codigo_status' => 4,
                'descricao_status' => 'Email inválido!'
            ];
            
            header("Location: ../index.php?status=".$this->status['codigo_status']."&msg=".$this->status['descricao_status']);

        }
        
        if($this->mensagemValida()){
            
            $mail = new PHPMailer(true);
            
            try {
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'pierri95@gmail.com';                     //SMTP username
                $mail->Password   = 'ffgicqhuzylnzsyw';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            
                //Recipients
                $mail->setFrom('pierri95@gmail.com', 'Bruno Pierri');
                $mail->addAddress($this->para);     //Add a recipient
                $mail->addAddress('pierri95@gmail.com');               //Name is optional
                $mail->addReplyTo('pierri95@gmail.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');
            
                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = $this->assunto;
                $mail->Body    = $this->mensagem;
                $mail->AltBody = 'É necessário utilizar um client que suporte html para ter acesso total ao conteúdo dessa mensagem';
            
                $mail->send();
                $this->status = [
                    'codigo_status' => 1,
                    'descricao_status' => 'E-mail enviando com sucesso'
                ];

                header("Location: ../index.php?status=".$this->status['codigo_status']."&msg=".$this->status['descricao_status']);
            } catch (Exception $e) {

                $this->status = [
                    'codigo_status' => 2,
                    'descricao_status' => 'Não foi possível enviar este e-mail!!! Tente novamente mais tarde.'.$mail->ErrorInfo
                ];
                
                header("Location: ../index.php?status=".$this->status['codigo_status']."&msg=".$this->status['descricao_status']);
            }


        }else{

            $this->status = [
                'codigo_status' => 3,
                'descricao_status' => 'Mensagem Inválida!!! Preencha os campos corretamente.'
            ];
            
            header("Location: ../index.php?status=".$this->status['codigo_status']."&msg=".$this->status['descricao_status']);
            
        }
    }

}