<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.calculhmac(clent, data)om>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\AccountsCashier\AccountsBillingPaymentPayeeInfo;

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
 * class NewAccountsBillingPaymentPayeeInfo.
 *
 * NewAccountsBillingPaymentPayeeInfo Controller
 *
 * @author Bardeson Lucky <flashup4all@gmail.com>
 * @since v0.0.1 08/06/2016 14:20
 */
class NewAccountsBillingPaymentPayeeInfo
{
	public static function newAccountBillingPaymentPayeeInfo(array $data)
	{
		$billingPaymentPayeeFullName = $data['billingPaymentPayeeFullName'] ?? 'NULL';
		$billingPaymentPayeePhoneNumber = $data['billingPaymentPayeePhoneNumber'] ?? 'NULL';
		$billingPaymentPayeeAddress = $data['billingPaymentPayeeAddress'] ?? 'NULL';

		$packed = [
			'BillingPaymentPayeeFullName'=>($billingPaymentPayeeFullName !== 'NULL') ? QB::wrapString($billingPaymentPayeeFullName, "'") : $billingPaymentPayeeFullName,
			'BillingPaymentPayeePhoneNumber'=>($billingPaymentPayeePhoneNumber !== 'NULL') ? QB::wrapString($billingPaymentPayeePhoneNumber, "'") : $billingPaymentPayeePhoneNumber,
			'BillingPaymentPayeeAddress'=>($billingPaymentPayeeAddress !== 'NULL') ? QB::wrapString($billingPaymentPayeeAddress, "'") : $billingPaymentPayeeAddress
		];

		$result = DatabaseQueryFactory::insert('Accounts.BillingPaymentPayeeInformation', $packed);
		return $result;
	}
}