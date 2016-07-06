<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.calculhmac(clent, data)om>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\AccountsCashier\AccountsBillingPayment;

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
 * class NewAccountsBillingPayment.
 *
 * NewAccountsBillingPayment Controller
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 * @since v0.0.1 08/06/2016 14:20
 */
class NewAccountsBillingPayment
{
	/**
	 *method newBillingPayment
	 * manages the creation of new billing Payment resource
	 * @author Bardeson Lucky <flashup4all@gmail.com>
	 * @since v.0.0.1 05/07/2016 08:48pm
	*/
	public static function default(array $data)
	{
		$billingPaymentNumber = $data['billingPaymentNumber'] ?? 'NULL';
		$billingPaymentPaidAmount = $data['billingPaymentPaidAmount'] ?? 'NULL';
		$billingPaymentPayee = $data['billingPaymentPayee'] ?? 'NULL';

		$packed = [
			'BillingPaymentNumber'=>($billingPaymentNumber !== 'NULL') ? QB::wrapString($billingPaymentNumber, "'") : $billingPaymentNumber,
			'BillingPaymentPaidAmount'=>($billingPaymentPaidAmount !== 'NULL') ? QB::wrapString($billingPaymentPaidAmount, "'") : $billingPaymentPaidAmount,
			'BillingPaymentPayee'=>($billingPaymentPayee !== 'NULL') ? QB::wrapString($billingPaymentPayee, "'") : $billingPaymentPayee,
		];

		$result = DatabaseQueryFactory::insert('Accounts.BillingPayment', $packed);
		return $result;
	}
}