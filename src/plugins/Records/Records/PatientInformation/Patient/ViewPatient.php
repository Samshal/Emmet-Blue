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
 * class ViewPatient.
 *
 * ViewPatient Controller
 *
 * @author Bardeson	Lucky <Ahead!!> <flashup4all@gmail.com>
 * @since v0.0.1 20/06/2016 10:03
 */
class ViewPatient
{
	/**
	 * viewPatientinfo method
	 *
	 * @param int $patientId
	 * @author bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
	 */
	public static function viewPatientInfo(int $patientId)
	{
		$selectBuilder = (new Builder('QueryBuilder','Select'))->getBuilder();
		$selectBuilder
			->columns('*')
			->from('Records.Patient')
			->where('PatientID ='.$patientId);
		try
		{
			$viewPatientOperation = (new DBConnectionFactory::getConnection())->query((string)$selectBuilder);

			DatabaseLog::log(
				Session::get('USER_ID'),
				Constant::EVENT_SELECT,
				'Records',
				'Patient',
				(string)$viewPatientOperation
			);

			if($viewPatientOperation)
			{
				return $viewPatientOperation->fetchAll();
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
	/**
	 * class ViewPatient.
	 *
	 * ViewPatientAddressInfo Method
	 *
	 * @author Bardeson	Lucky <Ahead!!> <flashup4all@gmail.com>
	 * @since v0.0.1 20/06/2016 10:04
	 */
	public static function viewPatientAddressInfo(int $patientId)
	{
		$selectBuilder = (new Builder('QueryBuilder','Select'))->getBuilder();
		$selectBuilder
			->columns('*')
			->from('Records.PatientAddressInformation')
			->where('PatientID ='.$patientId);
		try
		{
			$viewPatientAddress = (new DBConnectionFactory::getConnection())->query((string)$selectBuilder);

			DatabaseLog::log(
				Session::get('USER_ID'),
				Constant::EVENT_SELECT,
				'Records',
				'Patient',
				(string)$viewPatientAddress
			);

			if($viewPatientAddress)
			{
				return $viewPatientAddress->fetchAll();
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
	/**
	 * class ViewPatient.
	 *
	 * ViewPatientAddressInfo Method
	 *
	 * @author Bardeson	Lucky <Ahead!!> <flashup4all@gmail.com>
	 */
	public static function veiwPatientNextOfKinInfo(int $patientId)
	{
		$selectBuilder = (new Builder('QueryBuilder','Select'))->getBuilder();
		$selectBuilder
			->columns('*')
			->from('Records.NextOfKinIformation')
			->where('PatientID ='.$patientId);
		try
		{
			$veiwPatientNextOfKinInfo = (new DBConnectionFactory::getConnection())->query((string)$selectBuilder);

			DatabaseLog::log(
				Session::get('USER_ID'),
				Constant::EVENT_SELECT,
				'Records',
				'Patient',
				(string)$veiwPatientNextOfKinInfo
			);

			if($veiwPatientNextOfKinInfo)
			{
				return $veiwPatientNextOfKinInfo->fetchAll();
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