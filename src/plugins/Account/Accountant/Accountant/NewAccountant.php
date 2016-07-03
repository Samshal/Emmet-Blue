<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <flashup4all@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\plugins\Account\Accountant;

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
 * class NewAccountants.
 *
 * NewAccountant Controller
 *
 * @author Bardeson Lucky <flashup4all@gmail.com>
 * @since v0.0.1 08/06/2016 14:20
 */
class NewAccountant
{
	public static function default(array $data)
	{
		$title = $data['title'] ?? 'NULL';
		$firstName = $data['firstName'] ?? 'NULL';
		$middleName = $data['middleName'] ?? 'NULL';
		$lastName = $data['lastName'] ?? 'NULL';
		$gender = $data['gender'] ?? 'NULL';
		$dateOfBirth = $data['dateOfBirth'] ?? 'NULL';
		$accountantType = $data['accountantType'] ?? 'NULL'; //chief accountant, account officer etc

		$accountantData = [
			'Title' =>($title !== 'NULL') ? QB::wrapString($title, "'") : $title,
			'FirstName'=>($firstName !== 'NULL') ? QB::wrapString($firstName, "'") : $firstName,
			'MiddleName'=>($middleName !== 'NULL') ? QB::wrapString($middleName, "'") : $middleName,
			'LastName'=>($lastName !== 'NULL') ? QB::wrapString($lastName, "'") : $lastName,
			'Gender'=>($gender !== 'NULL') ? QB::wrapString($gender, "'") : $gender,
			'DateOfBirth'=>$dateOfBirth,
			'AccountantType' => ($accountantType !== 'NULL') ? QB::wrapString($accountantType, "'") : $accountantType,
			];

		$result = DatabaseQueryFactory::insert('Account.Accountant', $accountantData);
}