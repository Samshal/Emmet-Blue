<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <flashup4all@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\AccountsCashier;

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
 * @author Bardeson Lucky <flashup4all@gmail.com>
 * @since v0.0.1 08/06/2016 14:20
 */
class AccountsCashier
{
	public static function newAccountsBillingPaymentPayee(array $data)
	{
		return AccountsCashier\NewAccountsBillingPayment::newAccountBillingPaymentPayeeInfo($data);
	}

	public static function newAccountsBillingPayment(array $data)
	{
		return AccountsCashier\NewAccountsBillingPayment::newAccountBillingPayment($data);
	}

	public static function viewAccountsBillingPaymentPayee(int $billingPaymentPayeeId)
	{
		return AccountsCashier\ViewAccountsBillingPayment::viewAccountBillingPaymentPayeeInfo(int $billingPaymentPayeeId)
	}

	public static function viewAccountsBillingPayment(int $billingPaymentId)
	{
		return AccountsCashier\ViewAccountsBillingPayment::viewAccountBillingPayment(int $billingPaymentId);
	}

	public static function deleteAccountsBillingPayment(int $accountsBillingPaymentId)
	{
		return AccountsCashier\DeleteAccountsBillingPayment::delete($accountsBillingPaymentId);
	}
}