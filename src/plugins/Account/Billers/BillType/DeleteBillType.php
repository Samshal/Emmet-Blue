<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <flashup4all@gmail.com> <Ahead!!>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\plugins\Account\Billers\BillType;

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
 * class DeleteBillType.
 *
 * DeleteBillType Controller
 *
 * @author Bardeson Lucky <flashup4all@gmail.com>
 * @since v0.0.1 15/06/2016 14:20
 */
class DeleteBillType
{
	/**
	 * delete method
<<<<<<< HEAD:src/plugins/Account/Billers/Biller/DeleteBiller.php
	 * deleting a biller from the database
	 * @param int $BillersId
	 */
	public static function delete(int $BillerId)
=======
	 * deleting a billType from the database
	 * @param int $billTypeId
	 */
	public static function delete(int $billTypeId)
>>>>>>> f55a963df56d97e75e821ade4f47e08b6017cced:src/plugins/Account/Billers/BillType/DeleteBillType.php
	{
		$deleteBuilder = (new Builder('QueryBuilder', 'Delete'))->getBuilder();

		$deleteBuilder
			->from('Account.BillType')
			->where('BillType.BillTypeID = '.$billTypeId);

		try
		{
			$deleteBillType = (DBConnectionFactory::getConnection())->query((string)$deleteBuilder);

<<<<<<< HEAD:src/plugins/Account/Billers/Biller/DeleteBiller.php
			DatabaseLog::log(Session::get('USER_ID'), Constant::EVENT_DELETE,'Account', 'Biller', (string)$deleteBiller);
=======
			DatabaseLog::log(Session::get('USER_ID'), Constant::EVENT_DELETE, 'Account', 'BillType', (string)$deleteBillType);
>>>>>>> f55a963df56d97e75e821ade4f47e08b6017cced:src/plugins/Account/Billers/BillType/DeleteBillType.php

			if($deleteBillType)
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