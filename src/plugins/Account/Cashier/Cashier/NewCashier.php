<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\plugins\Account\Cashier\Cashier;

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
 * class NewCashier.
 *
 * NewCashier Controller
 *
 * @author Bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
 * @since v0.0.1 25/06/2016 03:27
 */
class NewCashier
{
	public static function default(array $data)
	{
		$title = $data['title'] ?? 'NULL';
		$firstName = $data['firstName'] ?? 'NULL';
		$middleName = $data['middleName'] ?? 'NULL';
		$lastName = $data['lastName'] ?? 'NULL';
		$gender = $data['gender'] ?? 'NULL';
		$dateOfBirth = $data['dateOfBirth'] ?? 'NULL';
		$cashierType = $data['cashierType'] ?? 'NULL';	 // chiefCashier, cashier etc..

		$cashierData = [
			'Title' =>($title !== 'NULL') ? QB::wrapString($title, "'") : $title,
			'FirstName'=>($firstName !== 'NULL') ? QB::wrapString($firstName, "'") : $firstName,
			'MiddleName'=>($middleName !== 'NULL') ? QB::wrapString($middleName, "'") : $middleName,
			'LastName'=>($lastName !== 'NULL') ? QB::wrapString($lastName, "'") : $lastName,
			'Gender'=>($gender !== 'NULL') ? QB::wrapString($gender, "'") : $gender,
			'DateOfBirth'=>$dateOfBirth,
			'CashierType' => ($cashierType !== 'NULL') ? QB::wrapString($cashierType, "'") : $cashierType,
			];

		$result = DatabaseQueryFactory::insert('Account.Cashier', $cashierData);
	}
}