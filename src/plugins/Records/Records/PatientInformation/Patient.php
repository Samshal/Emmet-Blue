<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\Records\Records\PatientInformation;

use EmmetBlue\Core\Builder\BuilderFactory as Builder;
use EmmetBlue\Core\Factory\DatabaseConnectionFactory as DBConnectionFactory;
use EmmetBlue\Core\Builder\QueryBuilder\QueryBuilder as QB;
use EmmetBlue\Core\Exception\SQLException;
use EmmetBlue\Core\Exception\UndefinedValueException;
use EmmetBlue\Core\Session\Session;
use EmmetBlue\Core\Logger\DatabaseLog;
use EmmetBlue\Core\Logger\ErrorLog;
use EmmetBlue\Core\Constant;

/**
 * class Patient.
 *
 * Patient Controller
 *
 * @author Bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
 * @since v0.0.1 20/06/2016 10:31
 */
class Patient
{
	# adding new patient resource
	public static function newPatient(array $data)
	{
		return Patient\NewPatient::default($data);
	}
	# adding patient address info resource
	public static function newPatientAddress(array $data)
	{
		return Patient\NewPatient::patientAddressInfo($data);
	}
	# adding a new patient next of kin resource
	public static function newPatientNextofKin(array $data)
	{
		return Patient\NewPatient::PatientNextOfKinInfo($data);
	}
	# view patient basic info
	public static function viewPatient(int $PatientId)
	{
		return Patient\ViewPatient::viewPatientInfo($patientId);
	}
	# view patient address info
	public static function viewPatientAddress(int $PatientId)
	{
		return Patient\ViewPatient::viewPatientAddressInfo($PatientId);
	}
	# view patient next of kin details
	public static function viewNextOfKin(int $PatientId)
	{
		return Patient\ViewPatient::veiwPatientNextOfKinInfo($PatientId);
	}
	# delete patient resource
	public static function deletePatient(int $PatientId)
	{
		return Patient\DeletePatient::DeletePatient($PatientId);
	}
}