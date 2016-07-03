<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\plugins\Account\Billers\BillType;

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
 * class ViewBillers.
 *
 * ViewBillers Controller
 *
 * @author Bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
 * @since v0.0.1 25/06/2016 03:27
 */
class ViewBillType
{ 
	/**
	 * viewBiller method
	 * viewing a biller info
	 * @param int $billersId
	 * @author bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
	 */
	public static function viewBillType()
	{
		$selectBuilder = (new Builder('QueryBuilder','Select'))->getBuilder();
		$selectBuilder
			->columns('*')
			->from('Account.BillType');
		try
		{
			$viewBillTypes = (new DBConnectionFactory::getConnection())->query((string)$selectBuilder);

			DatabaseLog::log(
				Session::get('USER_ID'),
				Constant::EVENT_SELECT,
				'Account',
				'BillType',
				(string)$viewBillTypes
			);

			if($viewBillTypes)
			{
				return $viewBillTypes->fetchAll();
			}
			throw new UndefinedValueException(
				sprintf(
					'Database error has occured'
				),
				(int)Session::get('USER_ID')
			);
			
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