<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Core\Factory;

use EmmetBlue\Core\Constant;

/**
 * Class MailerFactory.
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since v0.0.1 13/02/2017 13:06
 */
class MailerFactory
{
	private $mail;
	public function __construct(array $sender, array $recipients, array $message){
		$smtpConfigJson = file_get_contents(Constant::getGlobals()["config-dir"]["smtp-config"]);

        $smtpConfig = json_decode($smtpConfigJson);

		$mail = new \PHPMailer;
		$mail->SMTPDebug = $smtpConfig->debug;
		$mail->isSMTP();
		$mail->Host = $smtpConfig->host;
		$mail->SMTPAuth = $smtpConfig->auth;
		$mail->Username = $smtpConfig->user;
		$mail->Password = $smtpConfig->password;
		$mail->SMTPSecure = $smtpConfig->secure;
		$mail->Port = $smtpConfig->port;

		$mail->From = $sender["address"];
		$mail->FromName = $sender["name"];
		$mail->addReplyTo = $sender["replyTo"];

		foreach ($recipients as $key => $value) {
			$mail->addAddress($value["address"]);
		}

		$mail->Subject = $message["subject"];
		$mail->Body = $message["body"];
		$mail->AltBody = $message["alt"];
		$mail->isHTML($message["isHtml"]);

		$this->mail = $mail;
	}

	public function send(){
		if (!$this->mail->send()){
			return $this->mail->ErrorInfo;
		}

		return ["result"=>true];	
	}
}