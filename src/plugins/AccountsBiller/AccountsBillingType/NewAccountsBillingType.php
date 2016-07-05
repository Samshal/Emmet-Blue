<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.calculhmac(clent, data)om>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\AccountsBiller\AccountsBillingType;

use EmmetBlue\Core\Builder\BuilderFactory as Builder;
use EmmetBlue\Core\Factory\DatabaseConnectionFactory as DBConnectionFactory;
use EmmetBlue\Core\Factory\DatabaseQueryFactory as DatabaseQueryFactory;
use EmmetBlue\Core\Builder\QueryBuilder\QueryBuilder as QB;
use EmmetBlue\Core\Exception\SQLException;
use EmmetBlue\Core\Exception\UndefinedValueException;
use EmmetBlue\Core\Session\Session;
use EmmetBlue\Core\Logger\DatabaseLog;
use EmmetBlue\Core\Logger\ErrorLog;
use EmmetBlue\Core\Constant;

/**
 * class NewAccountsBillingType.
 *
 * NewAccountsBillingType Controller
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 * @since v0.0.1 08/06/2016 14:20
 */
class NewAccountsBillingType
{
	public static function default(array $data)
	{
		$billingTypeName = $data['billingTypeName'] ?? 'NULL';
		$billingTypeDescription = $data['billingTypeDescription'] ?? 'NULL';

		$packed = [
			'BillingTypeName'=>($billingTypeName !== 'NULL') ? QB::wrapString($billingTypeName, "'") : $billingTypeName,
			'BillingTypeDescription'=>($billingTypeDescription !== 'NULL') ? QB::wrapString($billingTypeDescription, "'") : $billingTypeDescription
		];

		$result = DatabaseQueryFactory::insert('Accounts.BillingType', $packed);
		return $result;
	}
}