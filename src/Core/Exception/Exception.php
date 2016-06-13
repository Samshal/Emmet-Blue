<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Core\Exception;

use EmmetBlue\Core\Logger\ErrorLog;

/**
 * class Exception.
 * Instantiates a new instance of Exception
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since v0.0.1 08/06/2016 14:20
 */
abstract class Exception extends \Exception
{
	protected $exception;

	public function __construct(string $message, int $code = 0, \Exception $previous = null)
	{
		parent::__construct($message, $code, $previous);
		$this->exception = $this;
	}

	public function log(int $databaseUserId, string $errorNumber, string $errorSeverity)
	{
		ErrorLog::log($databaseUserId, $errorNumber, $errorSeverity, $this->getMessage(), serialize($this));
	}
}