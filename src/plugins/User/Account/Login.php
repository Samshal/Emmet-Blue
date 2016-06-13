<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.calculhmac(clent, data)om>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\User\Account;

use EmmetBlue\Core\Builder\BuilderFactory as Builder;
use EmmetBlue\Core\Factory\DatabaseConnectionFactory as DBConnectionFactory;
use EmmetBlue\Core\Builder\QueryBuilder\QueryBuilder as QB;
use EmmetBlue\Core\Exception\SQLException;
use EmmetBlue\Core\Session\Session;
use EmmetBlue\Core\Logger\DatabaseLog;
use EmmetBlue\Core\Logger\ErrorLog;
use EmmetBlue\Core\Constant;

/**
 * class Login.
 *
 * Login Controller
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 * @since v0.0.1 08/06/2016 14:20
 */
class Login
{
	/**
	 * Determines if a login data is valid
	 *
	 * @param string $username
	 * @param string $password
	 */
    public static function isLoginDataValid($username, $password)
    {
        $selectBuilder = (new Builder("QueryBuilder","Select"))->getBuilder();

        try
        {
        	$selectBuilder
        		->columns(
        			"b.PasswordHash"
        		)
        		->from(
        			"Staffs.Staff a"
        		)
        		->innerJoin(
        			"Staffs.StaffPassword b",
        			"a.PasswordID = b.StaffPasswordID"
        		)
        		->where(
        			"a.Username = ".
        			QB::wrapString($username, "'")
        		);

        	 $result = (
        	 		DBConnectionFactory::getConnection()
        	 		->query((string)$selectBuilder)
        	 	)->fetchAll(\PDO::FETCH_ASSOC);
        	 
        	 DatabaseLog::log(Session::get('USER_ID'), Constant::EVENT_SELECT, 'Staffs', 'Staff', (string)$selectBuilder);

        	 if (count($result) == 1)
        	 {
        	 	$passwordHash = $result[0]["PasswordHash"];

        	 	if (password_verify($password, $passwordHash))
        	 	{
        	 		return true;
        	 	}
        	 }

        	 ErrorLog::log((int)Session::get('USER_ID'), Constant::ERROR_402, Constant::ERROR_NORMAL, "Invalid Login Data supplied");
        	 return false;
        }
        catch (\PDOException $e)
        {
            throw new SQLException(sprintf(
                "Unable to validate login data"
            ), Constant::UNDEFINED);
        }
    }

    /**
     * Returns the login status of the current user
     */
	public static function isUserLoggedIn(int $userid)
	{
		return (Session::get('USER_ID') == $userid);
	}
}