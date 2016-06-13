<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.calculhmac(clent, data)om>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\Permission;

use EmmetBlue\Core\Builder\BuilderFactory as Builder;
use EmmetBlue\Core\Factory\DatabaseConnectionFactory as DBConnectionFactory;
use EmmetBlue\Core\Builder\QueryBuilder\QueryBuilder as QB;
use EmmetBlue\Core\Exception\SQLException;
use EmmetBlue\Core\Session\Session;
use EmmetBlue\Core\Logger\DatabaseLog;
use EmmetBlue\Core\Logger\ErrorLog;
use EmmetBlue\Core\Constant;

/**
 * class Role.
 *
 * Role Controller
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 * @since v0.0.1 08/06/2016 14:20
 */
class Role
{
	/**
	 * Creates a new role in the database
	 *
	 * @param string $name
	 * @param string $description
	 */
	public static function new(string $name, string $description="")
	{
		$insertBuilder = (new Builder("QueryBuilder","Insert"))->getBuilder();

    	try
        {
            $insertBuilder
                ->into('
                    [Staffs].[Role]
                    (
                        Name,
                        Description
                    )
                ')
                ->values([
                    QB::wrapString($name, "'"),
                    QB::wrapString($description, "'")
                ]);

            $result = DBConnectionFactory::getConnection()->query((string)$insertBuilder);

            if ($result)
            {
	            DatabaseLog::log(Session::get('USER_ID'), Constant::EVENT_INSERT, 'Staffs', 'Role', $insertBuilder);
            }
            else
            {
            	ErrorLog::log(Session::get('USER_ID'), Constant::ERROR_403, Constant::ERROR_NORMAL, "Unable to create new Role");
            }

            return $result;
        }
        catch (\PDOException $e)
        {
            throw new SQLException(sprintf(
                "Unable to create new role"
            ), Session::get('USER_ID'));
        }
	}
}