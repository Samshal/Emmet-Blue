<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\plugins\Account\Cashier\Payment;

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
 * class NewCashier.
 *
 * NewCashier Controller
 *
 * @author Bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
 * @since v0.0.1 25/06/2016 03:27
 */
class NewPayment
{
	public static function default(array $data)
	{
		$patientId = $data['patientId'] ?? 'NULL';
		$invoiceNumber = $data['invoiceNumber'] ?? 'NULL';
		$cashierId = $data['cashierId'] ?? 'NULL';
		$chargedAmount = $data['chargedAmount'] ?? 'NULL';	// amount that was paid
		$amountPaid = $data['amountPaid'] ?? 'NULL';	// amount that was paid
		$paymentStatus = $data['paymentStatus'] ?? 'NULL';	// paid or unpaid
		$balance = $data['balance'] ?? 'NULL';			// if an incomplete amount was paid the balance b/f should be recorded
		$comment = $data['comment'] ?? 'NULL';
		$dateOfPayment = $data['dateOfPayment'] ?? 'NULL';
		$timeOfPayment = $data['dateOfPayment'] ?? 'NULL';
		$updatedDate = $data['updatedDate'] ?? 'NULL';
		$updatedTime = $data['updatedTime'] ?? 'NULL';

		$paymentStatusData = [
			'PatientID' =>($patientId !== 'NULL') ? QB::wrapString($patientId, "'") : $patientId,
			'InvoiceNumber'=>($invoiceNumber !== 'NULL') ? QB::wrapString($invoiceNumber, "'") : $invoiceNumber,
			'CashierID'=>($cashierId !== 'NULL') ? QB::wrapString($cashierId, "'") : $cashierId,
			'ChargedAmount'=>($chargedAmount !== 'NULL') ? QB::wrapString($chargedAmount, "'") : $chargedAmount,
			'AmountPaid'=>($amountPaid !== 'NULL') ? QB::wrapString($amountPaid, "'") : $amountPaid,
			'PaymentStatus'=>($paymentStatus !== 'NULL') ? QB::wrapString($paymentStatus, "'") : $paymentStatus,
			'Balance'=>($balance !== 'NULL') ? QB::wrapString($balance, "'") : $balance,	//if no balance (0.00)
			'Comment' => ($comment !== 'NULL') ? QB::wrapString($balance, "'") : $comment,
			'DateOfPayment' => $dateOfPayment,
			'TimeOfPayment' => $timeOfPayment,
			'UpdatedDate' => $updatedDate,
			'UpdatedTime' => $updatedTime,
			];

		$result = DatabaseQueryFactory::insert('Account.PaymentStatus', $paymentStatusData);
		($result) ?? $this->cashierReciept($result) : 'database error'; 
	}
	/**
	 * cashierReciept() method
	 * Print reciept 
	 * @var array $paymentStatus[]
	 */
	public static function Reciept(array $paymentStatus)
	{
		return $paymentStatus;
	}
}