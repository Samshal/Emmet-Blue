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
use EmmetBlue\Core\Builder\QueryBuilder\DeleteQueryBuilder;
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
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 * @since v0.0.1 08/06/2016 14:20
 */
class DeleteBody
{
	public static function delete($bodyId)
	{

		$deleteOperation = DeleteQueryBuilder::from('Mortuary.Body')
		->where("Body.BodyID = ".$BodyId);
		DatabaseLog::log(Session::get('USER_ID'), Constant::EVENT_DELETE,'Body', 'BodyID', $deleteOperation);
		if($deleteOperation)
		{
			return true;
		}
		throw new UndefinedValueException(
				sprintf("could not delete Body",$deleteOperation),
					(int)Session::get('USER_ID')
					);
		catch(\PDOException $e)
		{
			throw new SQLException(
				sprintf("Error Processing Request"
					), Constant::UNDEFINED);
			
		}
	}

}