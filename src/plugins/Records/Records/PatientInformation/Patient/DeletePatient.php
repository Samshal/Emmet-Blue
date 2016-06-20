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
 * class DeletePatient.
 *
 * DeletePatient Controller
 *
 * @author Bardeson	Lucky <Ahead!!> <flashup4all@gmail.com>
 * @since v0.0.1 20/06/2016 10:03
 */
class DeletePatient
{
	/**
	 * deletePatient method
	 *
	 * @param int $patientId
	 * @author bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
	 */
	public static function DeletePatient(int $patientId)
	{
		$deleteBuilder = (new Builder('QueryBuilder', 'Delete'))->getBuilder();

		$deleteBuilder
			->from('Records.Patient')
			->where('Records.PatientID = '.$patientId);

		try
		{
			$deletepatient = (DBConnectionFactory::getConnection())->query((string)$deleteBuilder);

			DatabaseLog::log(Session::get('USER_ID'), Constant::EVENT_DELETE,'Records', 'Patient', (string)$deletePatient);

			if($deletePatient)
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