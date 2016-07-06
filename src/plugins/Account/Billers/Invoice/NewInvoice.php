<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <flashup4all@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\plugins\Account\Billers\Invoice;

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
 * class Invoice.
 *
 * Invoice Controller
 *
 * @author Bardeson Lucky <flashup4all@gmail.com>
 * @since v0.0.1 03/07/2016
 */
class Invoice
{
	/**
	 * create method
	 * adding a new invoice to the database
	 * @param int $data[]
	 */

	public static function create(array $data)
	{
		$invoiceNumber = "SGH".mt_rand();
		$billerId = Session::get('USER_ID');
		$patientId = $data['patientId'] ?? 'NULL';
		$billType = $data['billType'] ?? 'NULL';		//New form,drugs, laboratory test, unknown etc;
		$title = $data['billTypeDescription'] ?? 'NULL';		//description of the billtypte above
		$invoiceEntries = $data['invoiceEntries'] ?? 'NULL';
		$status = $data['status'] ?? 'NULL';		//paid or unpaid
		$vatPercentage = $data['vatPercentage'] ?? 'NULL';
		$discount = $data['discount'] ?? 'NULL';
		$createdDate = $data['createdDate'] ?? 'NULL';
		//$dueDate = $data['updatedDate'] ?? 'NULL';	

		$billTypeData = [
			'billeriD' =>($billerId !== 'NULL') ? QB::wrapString($billerId, "'") : $billerId,
			'BillType'=>($billType !== 'NULL') ? QB::wrapString($billType, "'") : $billType,
			'BillTypeDescription'=>($billTypeDescription !== 'NULL') ? QB::wrapString($billTypeDescription, "'") : $billTypeDescription,
			'CreatedDate'=>$createdDate,
			'Updateddate' => $updatedDate,
			];
			
		$result = DatabaseQueryFactory::insert('Account.BillType', $billTypeData);
}