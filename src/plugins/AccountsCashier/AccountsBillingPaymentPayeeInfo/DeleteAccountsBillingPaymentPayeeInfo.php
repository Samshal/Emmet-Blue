<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <flashup4all@gmail.com> <Ahead!!>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\AccountsCashier\AccountsBillingPaymentPayeeInfo;

use EmmetBlue\Core\Builder\BuilderFactory as Builder;
use EmmetBlue\Core\Builder\QueryBuilder\DeleteQueryBuilder;
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
 * class DeleteAccountBillingPaymentPayeeInfo.
 *
 * DeleteAccountBillingPaymentPayeeInfo Controller
 *
 * @author Bardeson Lucky <flashup4all@gmail.com>
 * @since v0.0.1 15/06/2016 14:20
 */
class DeleteAccountsBillingPaymentPayeeInfo
{
	/**
	 * delete method
	 * @author Bardeson Lucky
	 * @param int $accountBillingPaymentPayeeId
	 */
	public static function delete(int $accountBillingPaymentPayeeId)
	{
		$deleteBuilder = (new Builder('QueryBuilder', 'Delete'))->getBuilder();

		$deleteBuilder
			->from('Account.BillingPaymentPayeeInformation')
			->where('BillingPaymentPayeeInformation.BillingPaymentPayeeID = '.$accountBillingPaymentPayeeId);

		try
		{
			$deleteOperation = (DBConnectionFactory::getConnection())->query((string)$deleteBuilder);

			DatabaseLog::log(Session::get('USER_ID'), Constant::EVENT_DELETE,'Account', 'BillingPayment', (string)$deleteOperation);

			if($deleteOperation)
			{
				return true;
			}

			throw new UndefinedValueException(
				sprintf(
					"A Database error has occurred."
				),
				(int)Session::get('USER_ID')
			);
		}
		catch(\PDOException $e)
		{
			throw new SQLException(
				sprintf(
					"Error Processing Request"
				),
				Constant::UNDEFINED
			);
			
		}
	}

}