<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Core\Factory;

/**
 * Class MailerFactory.
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since v0.0.1 13/02/2017 13:06
 */
class MailerFactory
{
	public function __construct(array $sender, array $recipients, array $message){
		$mail = new PHPMailer;
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

		return $mail->send();
	}
}