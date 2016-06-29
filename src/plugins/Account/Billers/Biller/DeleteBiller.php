<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <flashup4all@gmail.com> <Ahead!!>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\plugins\Account\Billers\Biller;

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
 * class DeleteBillers.
 *
 * DeleteBillers Controller
 *
 * @author Bardeson Lucky <flashup4all@gmail.com>
 * @since v0.0.1 15/06/2016 14:20
 */
class DeleteBiller
{
	/**
	 * delete method
	 * deleting a biller from the database
	 * @param int $billersId
	 */
	public static function delete(int $billerId)
	{
		$deleteBuilder = (new Builder('QueryBuilder', 'Delete'))->getBuilder();

		$deleteBuilder
			->from('Account.Biller')
			->where('Biller.BillerID = '.$billerId);

		try
		{
			$deleteBiller = (DBConnectionFactory::getConnection())->query((string)$deleteBuilder);

			DatabaseLog::log(Session::get('USER_ID'), Constant::EVENT_DELETE, 'Account', 'Biller', (string)$deleteBiller);

			if($deleteBiller)
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