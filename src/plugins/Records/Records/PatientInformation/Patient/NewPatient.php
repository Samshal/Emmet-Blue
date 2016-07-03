<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <flashup4all@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\Records\Records\PatientInformation\Patient;

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
 * class NewPatient.
 *
 * NewPatient Controller
 *
 * @author Bardeson	Lucky <Ahead!!> <flashup4all@gmail.com>
 * @since v0.0.1 08/06/2016 14:20
 */
class NewPatient
{
	public static function default(array $data)
	{
		$title = $data['title'] ?? 'NULL';
		$firstName = $data['firstName'] ?? 'NULL';
		$middleName = $data['middleName'] ?? 'NULL';
		$lastName = $data['lastName'] ?? 'NULL';
		$gender = $data['gender'] ?? 'NULL';
		$DateOfBirth = $data['dateOfBirth'] ?? 'NULL';
		$occupation = $data['ocupation'] ?? 'NULL';
		$patientType = $data['patientType'] ?? 'NULL'; //NHIS,company Patient,staff etc

		$defaultData = [
			'Title' =>($title !== 'NULL') ? QB::wrapString($title, "'") : $title,
			'FirstName'=>($firstName !== 'NULL') ? QB::wrapString($firstName, "'") : $firstName,
			'MiddleName'=>($middleName !== 'NULL') ? QB::wrapString($middleName, "'") : $middleName,
			'LastName'=>($lastName !== 'NULL') ? QB::wrapString($lastName, "'") : $lastName,
			'Gender'=>($gender !== 'NULL') ? QB::wrapString($gender, "'") : $gender,
			'DateOfBirth'=>$dateOfBirth
			'Occupation'=>($occupation !== 'NULL') ? QB::wrapString($occupation, "'") : $occupation,
			'PatientType' =>($patientType !== 'NULL') ? QB::wrapString($patientType, "'") : $patientType,
		];

		$result = DatabaseQueryFactory::insert('Records.Patient', $defaultData);
	}

	public static function patientAddressInfo(array $data)
	{
		$patientId = $data['PatientID'] ?? 'NULL';
		$phoneNumber = $data['phoneNumber'] ?? 'NULL';
		$email = $data['email'] ?? 'NULL';
		$address = $data['address'] ?? 'NULL';
		$stateOfResidence = $data['stateOfResidence'] ?? 'NULL';
		$nationality = $data['nationality'] ?? 'NULL';
		$stateOfOrigin = $data['stateOfOrigin'] ?? 'NULL';
		$localGovtArea = $data['localGovtArea'] ?? 'NULL';

		$addressInfo = [
			'PatientID'=>$patientId,
			'phoneNumber'=>($phoneNumber !== 'NULL') ? QB::wrapString($phoneNumber, "'") : $phoneNumber,
			'Email'=>($email !== 'NULL') ? QB::wrapString($email, "'") : $email,
			'Address'=>($Address !== 'NULL') ? QB::wrapString($address, "'") : $address,
			'StateOfResidence'=>($stateOfResidence !== 'NULL') ? QB::wrapString($stateOfResidence, "'") : $stateOfResidence,
			'Nationality'=>($nationality !== 'NULL') ? QB::wrapString($nationality, "'") : $nationality,
			'StateOfOrigin'=>($stateOfResidence !== 'NULL') ? QB::wrapString($stateOfResidence, "'") : $stateOfResidence,
			'LocalGovtArea'=>($localGovtArea !== 'NULL') ? QB::wrapString($localGovtArea, "'") : $localGovtArea,
		];

		$result = DatabaseQueryFactory::insert('Records.PatientAddressInformation', $addressInfo);
	}
	public static function PatientNextOfKinInfo(array $data)
	{
		$patientId = $data['PatientID'] ?? 'NULL';
		$nextOfKinFullName = $data['nextOfKinInfo'] ?? 'NULL';
		$nextOfKinAddress = $data['nextOfKinAddress'] ?? 'NULL';
		$nextOfKinState = $data['nextOfKinAddress'] ?? 'NULL';

		$nextOfKinInfo = [
			'PatientID'=>$patientId,
			'NextOfKinFullName'=>($nextOfKinFullName !== 'NULL') ? QB::wrapString($nextOfKinFullName, "'") : $nextOfKinFullName,
			'NextOfKinAddress'=>($nextOfKinAddress !== 'NULL') ? QB::wrapString($nextOfKinAddress, "'") : $nextOfKinAddress,
			'NextOfKinState'=>($nextOfKinState !== 'NULL') ? QB::wrapString($nextOfKinState, "'") : $nextOfKinState,
			'StateOfResidence'=>($stateOfResidence !== 'NULL') ? QB::wrapString($stateOfResidence, "'") : $stateOfResidence,
			'Nationality'=>($nationality !== 'NULL') ? QB::wrapString($nationality, "'") : $nationality,
			'StateOfOrigin'=>($stateOfResidence !== 'NULL') ? QB::wrapString($stateOfResidence, "'") : $stateOfResidence,
			'LocalGovtArea'=>($localGovtArea !== 'NULL') ? QB::wrapString($localGovtArea, "'") : $localGovtArea,
		];

		$result = DatabaseQueryFactory::insert('Records.NextOfKinIformation', $nextOfKinInfo);
	}
	/**
	 *Patient former health provider registration details 
	 */
	public static function formerHealthProvider()
	{

	}
}