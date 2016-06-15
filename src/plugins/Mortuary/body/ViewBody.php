<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.calculhmac(clent, data)om>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\Mortuary\Body;

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
 * class ViewBody.
 *
 * ViewBody Controller
 *
 * @author Chukwuma Nwali <chukznwali@gmail.com>
 * @since v0.0.1 08/06/2016 14:2016
 *
 * @param int $BodyId
 * accepts a $BodyId parameter to use for querying the table
 */
class ViewBody
{ 
public static function default(int $BodyId)
{
<<<<<<< HEAD

=======
>>>>>>> c23353b4a9ac7b79c77f7bbe8b507dff2c10bc9f
$selectBuilder = (new Builder("QueryBuilder", "Select"))->getBuilder();
	$selectBuilder
	->columns('*')
	->from('Mortuary.Body')
	->where('BodyId ='.$BodyId);
	
	try {
	$viewBodyquery=(new DbconnectionFactory::getConnection())->query((string)$selectBuilder);
	DatabaseLog::log(Session::get('USER_ID'), Constant::EVENT_SELECT,'Mortuary', 'Body', (string)$viewBodyquery);

	if($viewBodyquery){
	return $viewBodyQuery->fetchAll();
	} 
	throw new UndefinedValueException(
	sprintf(
	"A Database error occurred."
	),
	(int)Session::get('USER_ID')
	);

} catch(\PDOException $e)
		{
		throw new SQLException(
		sprintf(
		"Error Processing Request"
		),
		Constant::UNDEFINED
<<<<<<< HEAD
		);
=======
>>>>>>> c23353b4a9ac7b79c77f7bbe8b507dff2c10bc9f

	public static function default(array $data)
	{
		
	}

	/**
	 * viewBodyinfo method
	 *
	 * @param int $bodyId
	 * @author bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
	 */
	public static function viewBodyInfo(int $bodyId)
	{
		$selectBuilder = (new Builder('QueryBuilder','Select'))->getBuilder();
		$selectBuilder
			->columns('*')
			->from('Mortuary.BodyInformation')
			->where('BodyID ='.$bodyId);
		try
		{
			$viewBodyOperation = (new DBConnectionFactory::getConnection())->query((string)$selectBuilder);

			DatabaseLog::log(
				Session::get('USER_ID'),
				Constant::EVENT_SELECT,
				'Mortuary',
				'BodyInformation',
				(string)$deleteOperation
			);

			if($viewBodyOperation)
			{
				return $viewBodyOperation->fetchAll();
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
} }