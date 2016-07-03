<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\Account\Billers\Biller;

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
 * class ViewBillers.
 *
 * ViewBillers Controller
 *
 * @author Bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
 * @since v0.0.1 25/06/2016 03:27
 */
class UpdateBillers
{ 
	/**
	 * updateBiller method
	 * updating a biller data/info
<<<<<<< HEAD:src/plugins/Account/Billers/Biller/UpdateBiller.php
	 * @param int $BillersId
	 */
	public static function updateBiller(int $BillersId)
=======
	 * @param int $billersId
	 */
	public static function updateBiller(int $billersId)
>>>>>>> f55a963df56d97e75e821ade4f47e08b6017cced:src/plugins/Account/Billers/BillType/UpdateBillType.php
	{
		
	}
}