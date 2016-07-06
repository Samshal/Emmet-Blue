<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <flashup4allgmail.com>
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
 * class ViewAccountBillingPaymentPayeeInfo.
 *
 * ViewAccountBillingPaymentPayeeInfo Controller
 *
 * @author Bardeson Lucky <flashup4all@gmail.com>
 * @since v0.0.1 08/06/2016 14:2016
 */
class ViewAccountsBillingPaymentPayeeInfo
{ 
	/**
	 * viewAccountBillingPaymentPayeeInfo method
	 *
	 * @param int $accountBillingPaymentPayeeId
	 * @author bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
	 */
	public static function viewAccountBillingPaymentPayeeInfo(int $billingPaymentPayeeId)
	{
		$selectBuilder = (new Builder('QueryBuilder','Select'))->getBuilder();
		$selectBuilder
			->columns('*')
			->from('Account.BillingPaymentPayeeInformation')
			->where('BillingPaymentPayeeID ='.$billingPaymentPayeeId);
		try
		{
			$viewBillingPaymentPayeeOperation = (DBConnectionFactory::getConnection()->query((string)$selectBuilder))->fetchAll(\PDO::FETCH_ASSOC);

			DatabaseLog::log(
				Session::get('USER_ID'),
				Constant::EVENT_SELECT,
				'Account',
				'BillingPaymentPayeeInformation',
				(string)$selectBuilder
			);

			if(count($viewBillingPaymentPayeeOperation) > 0)
			{
				return $viewBillingPaymentPayeeOperation;
			}
			else
			{
				return null;
			}			
		} 
		catch (\PDOException $e) 
		{
			throw new SQLException(
				sprintf(
					"Error procesing request"
				),
				Constant::UNDEFINED
			);
			
		}
	}
}