<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.calculhmac(clent, data)om>
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

/**
 * class Body.
 *
 * Body Controller
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 * @since v0.0.1 08/06/2016 14:20
 */
class Body
{
	public static function newBody(array $data)
	{
		return Body\NewBody::default($data);
	}

	public static function newBodyInfo(array $data)
	{
		return Body\NewBody::info($data);
	}

	public static function viewBody(int $body)
	{
		return Body\ViewBody::viewBody($body);
	}

	public static function viewBodyInfo(int $body)
	{
		return Body\ViewBody::viewBodyInfo($body);
	}

	public static function deleteBody(int $body)
	{
		return Body\DeleteBody::delete($body);
	}
}