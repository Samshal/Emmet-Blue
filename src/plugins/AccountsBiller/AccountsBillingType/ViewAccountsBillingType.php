<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <flashup4all@gmail.com>
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
 * class ViewAccountBillingType.
 *
 * ViewAccountBillingType Controller
 *
 * @author Bardeson Lucky <flashup4all@gmail.com>
 * @since v0.0.1 08/06/2016 14:2016
 */
class ViewAccountsBillingType
{ 
	/**
	 * viewAccountBillingType method
	 *
	 * @param int $accountBillingTypeId
	 * @author bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
	 */
	public static function viewAccountsBillingType(int $billingTypeId)
	{
		$selectBuilder = (new Builder('QueryBuilder','Select'))->getBuilder();
		$selectBuilder
			->columns('*')
			->from('Accounts.BillingType');
		if ($billingTypeId != 0){
			$selectBuilder->where('BillingTypeID ='.$billingTypeId);
		}
		
		try
		{
			$viewAccountBillingTypeOperation = (DBConnectionFactory::getConnection()->query((string)$selectBuilder))->fetchAll(\PDO::FETCH_ASSOC);

			DatabaseLog::log(
				Session::get('USER_ID'),
				Constant::EVENT_SELECT,
				'Accounts',
				'BillingType',
				(string)$selectBuilder
			);

			if(count($viewAccountBillingTypeOperation) > 0)
			{
				return $viewAccountBillingTypeOperation;
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