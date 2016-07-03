<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <flashup4all@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\plugins\Account\Accountant;

use EmmetBlue\Core\Builder\BuilderFactory as Builder;
use EmmetBlue\Core\Factory\DatabaseConnectionFactory as DBConnectionFactory;
use EmmetBlue\Core\Builder\QueryBuilder\QueryBuilder as QB;
use EmmetBlue\Core\Exception\SQLException;
use EmmetBlue\Core\Exception\UndefinedValueException;
use EmmetBlue\Core\Session\Session;
use EmmetBlue\Core\Logger\DatabaseLog;
use EmmetBlue\Core\Logger\ErrorLog;
use EmmetBlue\Core\Constant;

/**
 * class Accountants.
 *
 * Accountants Controller
 *
 * @author Bardeson Lucky <Ahead!!><flashup4all@gmail.com>
 * @since v0.0.1 25/06/2016 03:27
 */
class Accountants
{
	public static function newAccountant(array $data)
	{
		return Accountant\NewAccountant::default($data);
	}

	public static function viewAccountant(int $accountantId)
	{
		return Accountant\ViewAccountant::viewAccountant($accountantId);
	}

	public static function deleteAccountant(int $accountantId)
	{
		return Accountant\DeleteAccountant::delete($accountantId);
	}
}