<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'../vendor/phpmailer/phpmailer/PHPMailerAutoload.php');

class Mailer {
  private $subject;
  private $body;
  private $emailAddress;
  protected $CI;

  public function __construct(){
    $this->subject = null;
    $this->body = null;
    $this->emailAddress = [];
    $this->CI =& get_instance();
  }

  //agregar proceso de envio de plantillas

  public function setSubject($subject){ 
    if(strlen(trim($subject)) === 0){
      throw new Exception('El asunto no puede quedar vacio',17001);
    }
    $this->subject = $subject;
    return $this;
  }

  public function setBody($body){
    if(strlen(trim($body)) === 0){
      throw new Exception('El cuerpo no puede quedar vacio',17002);
    }
    $this->body = $body;
    return $this;
  }

  public function setEmail($emailAddress){ 
    if(strlen(trim($emailAddress)) === 0){
      throw new Exception('El email no puede quedar vacio',17003);
    }
    if(! preg_match('/^\w+([\.\+\-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/', $emailAddress)){
      throw new Exception('Formato de correo inválido - "ejemplo@dominio.com"',17004);
    }
    array_push($this->emailAddress,$emailAddress);
    return $this;
  }

  public function sendMail(){
		$mail = new PHPMailer(true);
		try{
			$mail->IsSMTP();
			$mail->CharSet="UTF-8";
      $mail->SMTPOptions = array(
        'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
        )
      );
			$mail->SMTPSecure = 'tls';
			$mail->SMTPDebug = 0;
			$mail->Host = '	mx1.hostinger.co';
			$mail->Port = 587;

			$mail->Username = 'avisosplataforma@alimentosyvinosdeespana.com';
			$mail->Password = 'eiO9Z2WMegWC';
			$mail->SMTPAuth = true;
			
			$mail->From = 'avisosplataforma@alimentosyvinosdeespana.com';
			$mail->FromName = 'Avisos Hospedamemx';
      foreach($this->emailAddress AS $emailAddress){
        $mail->AddAddress($emailAddress);
      }
			$mail->IsHTML(true);
			$mail->Subject = $this->subject;
			$mail->AltBody = "Utilice un cliente compatible con HTML";
			$mail->Body = $this->body;
      $mail->send();
      $this->emailAddress = [];
		} catch (phpmailerException $e) {
			throw new Exception($e->errorMessage(),2310458);
		}catch (Exception $e) {
			throw new Exception($e->getMessage(),9782768);
		}
  }
  
  public function validateRecaptch(){ }

}
