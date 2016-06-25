<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <flashup4all@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\Account\Billers;

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
 * class Billers.
 *
 * Billers Controller
 *
 * @author Bardeson Lucky <Ahead!!><flashup4all@gmail.com>
 * @since v0.0.1 25/06/2016 03:27
 */
class Billers
{
	public static function newBiller(array $data)
	{
		return Billers\NewBiller::default($data);
	}

	public static function viewBiller(int $BillerId)
	{
		return Billers\ViewBiller::viewBiller($billerId);
	}

	public static function deleteBiller(int $BillerId)
	{
		return Billers\DeleteBiller::delete($BillerId);
	}
}