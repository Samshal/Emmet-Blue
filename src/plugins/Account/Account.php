<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <flashup4all@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
<<<<<<< HEAD
namespace EmmetBlue\Plugins\Account\Cashier;
=======
namespace EmmetBlue\plugins\Account;
>>>>>>> f55a963df56d97e75e821ade4f47e08b6017cced

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
 * class Account.
 *
 * Cashier Controller
 *
 * @author Bardeson Lucky <Ahead!!><flashup4all@gmail.com>
 * @since v0.0.1 25/06/2016 03:27
 */
class Cashier
{
	public static function newAccount(array $data)
	{
		return Account\NewAccount::default($data);
	}

<<<<<<< HEAD
	public static function viewCashier(int $CashierId)
=======
	public static function viewAccount(int $accountId)
	{
		return Account\ViewAccount::viewAccount($accountId);
	}

	public static function deleteAccount(int $accountId)
	{
		return Account\DeleteAccount::delete($accountId);
	}
	public static function viewCashier(int $cashierId)
>>>>>>> f55a963df56d97e75e821ade4f47e08b6017cced
	{
		return Cashier\ViewCashier::viewCashier($CashierId);
	}

	public static function deleteCashier(int $CashierId)
	{
		return Cashier\DeleteCashier::delete($CashierId);
	}
}