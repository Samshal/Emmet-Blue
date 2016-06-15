<?php
/**
 * @license MIT
 * @author 
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\User\Consultant;

use EmmetBlue\Core\Builder\BuilderFactory as Builder;
use EmmetBlue\Core\Factory\DatabaseConnectionFactory as DBConnectionFactory;
use EmmetBlue\Core\Builder\QueryBuilder\QueryBuilder as QB;
use EmmetBlue\Core\Exception\SQLException;
use EmmetBlue\Core\Exception\UndefinedValueException;
use EmmetBlue\Core\Session\Session;
use EmmetBlue\Core\Logger\DatabaseLog;
use EmmetBlue\Core\Logger\ErrorLog;
use EmmetBlue\Core\Constant;
use EmmetBlue\plugins\User\Account;
/**
 * Class Medication
 *this class manages all medication of a patient
 */
 class Medication{
 	/**
	*the constructor instantiates once any request is made to this class
	*@param 
	*@return 
 	*/
 	public function __construct()
 	{
 		
 	}
 	/**
	* this method creates new medication
	*@param $data which is an array
 	*/
	public static function newMedication(array $data)
 	{
 		$consultantId = $data['consultantId'] ?? 'NULL';
		$patientId = $data['patientId'] ?? 'NULL';
		$caseHistroy = $data['caseHistory'] ?? 'NULL';
		$medication = $data['medication'] ?? 'NULL';
		$consultantNote = $data['consultantNote'] ?? 'NULL';

		$data = [
			'ConsultantId'=>$consultantId,
			'PatientId'=>$consultantId,
			'CaseHistory'=>($caseHistory !== 'NULL') ? QB::wrapString($caseHistory, "'") : $caseHistory,
			'Medication'=>($medication !== 'NULL') ? QB::wrapString($medication, "'") : $medication,
			'ConsultantNote'=>($consultantNote !== 'NULL') ? QB::wrapString($consultantNote, "'") : $consultantNote,
			'currentDate'=>$currentDate,
		];

		$result = DatabaseQueryFactory::insert('Patient.Medication', $data);
 	}

 	public static function retrieveMedication($patientID)
 	{
 		$selectBuilder = (new Builder('QueryBuilder', 'Select *'))->getBuilder();
		try
		{
			$selectBuilder
			->from('Patient.Medicationhistory')
			->where("Medicationhistory.Patientid = ".QB::wrapString($patientId,"'")
				);
			$result = (
					DBConnectionFactory::getConnection()
					->query((string)$selectBuilder)
					)->fetchAll(\PDO::FETCH_ASSOC);
			DatabaseLog::log(Session::get('USER_ID'), Constant::_EVENT_SELECT, 'Patient','Medicationhistory',(string)$selectBuilder);
			if($result)
			{
				return $result;
			}
			throw new UndefinedValueException(
				sprintf("could not return medication history for this patient",$result),
					(int)Session::get('USER_ID')
					);			
		}
		catch(\PDOException $e)
		{
			throw new SQLException(
				sprintf("Error Processing Request"
					), Constant::UNDEFINED);
			
		}
 	}

 	public static function edit($id)
 	{

 	}

 	public static function update()
 	{

 	}

 	public static function delete()
 	{
 		
 	}
 }