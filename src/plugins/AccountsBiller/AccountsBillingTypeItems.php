<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <flashup4all@gmail.com>
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
 * @author Bardeson Lucky
 * @since v0.0.1 08/06/2016 14:20
 */
class AccountsBillingTypeItems
{
	public static function newAccountsBillingTypeItems(array $data)
	{
		return AccountsBillingTypeItems\NewAccountsBillingTypeItems::default($data);
	}

	public static function viewAccountsBillingTypeItems(int $accountsBillingTypeItemId)
	{
		return AccountsBillingTypeItems\ViewAccountsBillingTypeItems::viewAccountBillingTypeItems($accountsBillingTypeItemId);
	}

	public static function deleteAccountsBillingTypeItems(int $accountsBillingTypeItemId)
	{
		return AccountsBillingTypeItems\DeleteAccountsBillingTypeitems::delete($accountsBillingTypeitemId);
	}
}