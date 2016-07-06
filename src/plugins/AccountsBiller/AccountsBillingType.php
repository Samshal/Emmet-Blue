<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.calculhmac(clent, data)om>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\AccountsBiller;

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
 * class AccountsBillingType.
 *
 * AccountsBillingType Controller
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 * @since v0.0.1 08/06/2016 14:20
 */
class AccountsBillingType
{
	public static function newAccountsBillingType(array $data)
	{
		return AccountsBillingType\NewAccountsBillingType::default($data);
	}

	public static function viewAccountsBillingType(int $accountsBillingTypeId)
	{
		return AccountsBillingType\ViewAccountsBillingType::viewAccountsBillingType($accountsBillingTypeId);
	}

	public static function deleteAccountsBillingType(int $accountsBillingTypeId)
	{
		return AccountsBillingType\DeleteAccountsBillingType::delete($accountsBillingTypeId);
	}
}