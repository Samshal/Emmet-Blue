<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\Records\Records\VitalSign\VitalSign;

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
 * class ViewVitalsigns
 *
 * ViewVitalSigns Controller
 *
 * @author Bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
 * @since v0.0.1 16/06/2016 12:56am
 */
class ViewVitalSign
{
	/**
	 * method ViewVitalsign
	 *
	 * ViewVitalSign Controller
	 *
	 * @author Bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
	 * @since v0.0.1 17/06/2016 05:43am
	 */
	
	public static function viewVitalsign(int $patientId)
	{
		$selectBuilder = (new Builder('QueryBuilder','Select'))->getBuilder();
		$selectBuilder
			->columns('*')
			->from('Records.VitalSign')
			->where('PatientID ='.$patientId);
		try
		{
			$viewVitalOperation = (new DBConnectionFactory::getConnection())->query((string)$selectBuilder);

			DatabaseLog::log(
				Session::get('USER_ID'),
				Constant::EVENT_SELECT,
				'Records',
				'VitalSign',
				(string)$viewVitalOperation
			);

			if($viewVitalOperation)
			{
				return $viewVitalOperation->fetchAll();
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