<?php
include_once(__DIR__.'/phpmailer/class.phpmailer.php');
include_once(__DIR__.'/phpmailer/class.smtp.php');
class Mailer
{
	public function __construct()
	{
		
	}
	public function sendRemoteServer($sender,$subject,$html,$to)
	{
		$post = array(
			'sender' => $sender,
			'subject' => $subject,
			'html'   => $html,
			'to'   => $to,
			'security' => '54392db605e1f420');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://ses.giantlogistics.co.id');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
		$response = curl_exec($ch);
		return json_decode($response);
	}
	public function sendEmail($sender,$subject,$html,$to)
	{
		$mail               = new PHPMailer();
		
		$mail->IsSMTP(true); // SMTP
		$mail->SMTPAuth     = 1;  // SMTP authentication
		$mail->Mailer       = "smtp";
		//$mail->SMTPDebug = 2;
		$mail->SMTPSecure   = 'tls';
		//$mail->Host         = "tls://email-smtp.us-east-1.amazonaws.com"; // Amazon SES
		$mail->Host         = "srv127.niagahoster.com"; // Amazon SES
		$mail->Port         = 465;  // SMTP Port
		$mail->Username     = "noreply@artsky.cloud";  // SMTP  Username
		$mail->Password     = "!Gatekbgt2";  // SMTP Password
		$mail->SetFrom($sender['email'], $sender['name']);
		$mail->Subject      = $subject;
		$mail->MsgHTML($html);
		$mail->AddAddress($to);
		//$mail->AddAttachment(__DIR__.'/img/invoicecargoadditional-mei2016.pdf');
		//$mail->AddAttachment(__DIR__.'/img/jaminsem_default.sql.qz');
		//$mail->AddEmbeddedImage(__DIR__.'/img/Screenshot_161.jpg', '161');
		//$mail->AddEmbeddedImage(__DIR__.'/img/Screenshot_162.jpg', '162');
		//$mail->AddEmbeddedImage(__DIR__.'/img/Screenshot_163.jpg', '163');
		//$mail->AddEmbeddedImage(__DIR__.'/img/Screenshot_164.jpg', '164');
		if($mail->Send())
		{
			return true;
		}
		//echo "Mailer Error: " . $mail->ErrorInfo;
		return false;
	}
}
?>