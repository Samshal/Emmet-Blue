<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.calculhmac(clent, data)om>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\AccountsBiller\AccountsBillingTypeItemsPrices;

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
 * class NewAccountsBillingTypeItemsPrices.
 *
 * NewAccountsBillingTypeItemsPrices Controller
 *
 * @author Bardeson Lucky <flashup4all@gmail.com>
 * @since v0.0.1 08/06/2016 14:20
 */
class NewAccountsBillingTypeItemsPrices
{
	/**
	 *method newBillingTypeItemsPrices
	 * manages the creation of new billing item prices resource
	 * @author Bardeson Lucky
	 * @since v.0.0.1 05/07/2016 08:48pm
	*/
	public static function default(array $data)
	{
		$billingTypeItemId = $data['billingTypeItemId'] ?? 'NULL';
		$billingTypeItemsPrices = $data['billingTypeItemPrice'] ?? 'NULL';

		$packed = [
			'BillingTypeItemID'=>($billingTypeItemId !== 'NULL') ? QB::wrapString($billingTypeItemId, "'") : $billingTypeItemId,
			'BillingTypeItemsPrices'=>($billingTypeItemsPrices !== 'NULL') ? QB::wrapString($billingTypeItemsPrices, "'") : $billingTypeItemsPrices
		];

		$result = DatabaseQueryFactory::insert('Accounts.BillingTypeItemsPrices', $packed);
		return $result;
	}
}