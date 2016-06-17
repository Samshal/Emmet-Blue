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
 * class DeleteVitalSigns
 *
 * DeleteVitalSigns Controller
 *
 * @author Bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
 * @since v0.0.1 16/06/2016 12:56am
 */
class DeleteVitalSigns
{
	
	public static function deleteVitalsign(int $vitalSignId)
	{
		$deleteBuilder = (new Builder('QueryBuilder', 'Delete'))->getBuilder();

		$deleteBuilder
			->from('Records.VitalSign')
			->where('VitalSignID = '.$vitalSIgnId);

		try
		{
			$deleteVitalOperation = (DBConnectionFactory::getConnection())->query((string)$deleteBuilder);

			DatabaseLog::log(
				Session::get('USER_ID'),
				Constant::EVENT_DELETE,
				'Records', 'VitalSign',
				 (string)$deleteVitalOperation);

			if($deleteVitalOperation)
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