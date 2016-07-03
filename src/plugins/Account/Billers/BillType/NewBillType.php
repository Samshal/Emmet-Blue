<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <flashup4all@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\plugins\Account\Billers\BillType;

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
 * class NewBillType.
 *
 * NewBillType Controller
 *
 * @author Bardeson Lucky <flashup4all@gmail.com>
 * @since v0.0.1 08/06/2016 14:20
 */
class NewBillType
{
	/**
	 * create method
	 * adding a new billtype to the database
	 * @param int $data[]
	 */

	public static function create(array $data)
	{
		$billerId = Session::get('USER_ID');
		$billType = $data['billType'] ?? 'NULL';		//New form,drugs, laboratory test, unknown etc;
		$billTypeDescription = $data['billTypeDescription'] ?? 'NULL';		//description of the billtypte above
		$createdDate = $data['createdDate'] ?? 'NULL';
		$updatedDate = $data['updatedDate'] ?? 'NULL';	

		$billTypeData = [
			'billeriD' =>($billerId !== 'NULL') ? QB::wrapString($billerId, "'") : $billerId,
			'BillType'=>($billType !== 'NULL') ? QB::wrapString($billType, "'") : $billType,
			'BillTypeDescription'=>($billTypeDescription !== 'NULL') ? QB::wrapString($billTypeDescription, "'") : $billTypeDescription,
			'CreatedDate'=>$createdDate,
			'Updateddate' => $updatedDate,
			];
			
		$result = DatabaseQueryFactory::insert('Account.BillType', $billTypeData);
}