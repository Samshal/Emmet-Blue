<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <flashup4all@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\plugins\Account\Billers;

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
		return Biller\NewBiller::default($data);
	}

	public static function viewBiller(int $billerId)
	{
		return Biller\ViewBiller::viewBiller($billerId);
	}

	public static function deleteBiller(int $billerId)
	{
		return Biller\DeleteBiller::delete($billerId);
	}
	/**
	 * BillType methods for handling all BillType resources
	 *@author Bardeson Lucky <Ahead!!>
	 */
	public static function newBillType(array $data)
	{
		return BillType\NewBillType::create($data);
	}
	public static function ViewBillType()
	{
		return BillType\ViewBillType::viewBillType();
	}
	public static function deleteBillType(int $billTypeId)
	{
		return BillType\DeleteBillType::delete($billTypeId);
	}
	/**
	 * Billing methods controller
	 */
}