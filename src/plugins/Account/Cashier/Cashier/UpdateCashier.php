<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Bardeson Lucky <flashup4all@gmail.com> <Ahead!!>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\Account\Cashier\Cashier;

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
 * class DeleteCashier.
 *
 * DeleteCashier Controller
 *
 *  @author Bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
 * @since v0.0.1 25/06/2016 03:27
 */
class UpdateCashier
{
<<<<<<< HEAD
	/**
	 * delete method
	 *
	 * @param int $CashierId
	 */
	public static function update(int $CashierId)
=======
<<<<<<< HEAD
	/**
	 * delete method
	 *
	 * @param int $cashierId
	 */
	public static function update(int $cashierId)
>>>>>>> f55a963df56d97e75e821ade4f47e08b6017cced
	{
		
	}

<<<<<<< HEAD
}
=======
}
=======
    /**
     * delete method
     *
     * @param int $CashierId
     */
    public static function update(int $CashierId)
    {
    }
}
>>>>>>> add39830168a306825267326192a98c08cecbf3e
>>>>>>> f55a963df56d97e75e821ade4f47e08b6017cced
