<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Chukwuma Nwali <chukznwali@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\Mortuary;

use EmmetBlue\Core\Builder\BuilderFactory as Builder;
use EmmetBlue\Core\Factory\DatabaseConnectionFactory as DBConnectionFactory;
use EmmetBlue\Core\Builder\QueryBuilder\QueryBuilder as QB;
use EmmetBlue\Core\Exception\SQLException;
use EmmetBlue\Core\Exception\UndefinedValueException;
use EmmetBlue\Core\Session\Session;
use EmmetBlue\Core\Logger\DatabaseLog;
use EmmetBlue\Core\Logger\ErrorLog;
use EmmetBlue\Core\Constant;


class Records{
/**
* @param $PatientId uses it access the patient
* that the results is needed.
*/
public statiic function viewlabResults(int $PatientId){
$selectBuilder = (new Builder('QueryBuilder','Select'))->getBuilder();
	$selectBuilder
		->columns('Firstname, lastName, LabType, Age, LabDate, LabResults,
		 LabScientistFirstName, LabScientistLastName')
		->from('Records.LabData, Records.LabData')
		->where('Records.Labdata.PatientId ='.$PatientId AND 
				'Records.LabData.PatientId ='.$PatientId);
try{
$viewlab = (new DBConnectionFactory::getConnection())->query((string)$selectBuilder);

DatabaseLog::log(
				Session::get('USER_ID'),
				Constant::EVENT_SELECT,
				'Records',
				'PatientData',
				'Records',
				'LabData',
				(string)$viewLab
			);
if(isset($viewLab)){
return $viewlab->fetchAll(); 
	}
throw new undefinedValueException(
			sprintf(
				'Database error occured'
				),
			(int)Session::get('USER_ID')
			);	
}catch (\PDOException $e) 
			{
		throw new SQLException(
				sprintf(
				"Error procesing request"
					),
				Constant::UNDEFINED
				);
	}
}