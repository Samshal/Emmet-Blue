<?php declare(strict_types=1);

/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Core\Validator\Validators;

use EmmetBlue\Core\Validator\ValidatorInterface;
use EmmetBlue\Core\Builder\BuilderFactory as Builder;

/**
 * Class UserIDValidator
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since v0.0.1 08/06/2016 14:20
 */
class UserIDValidator implements ValidatorInterface
{
	public function isValidUserId(string $userId)
	{
		$selectQuery = (new Builder('QueryBuilder', 'Select'))->getBuilder();

		$selectQuery
			->top(1)
			->columns('StaffID')
			->from('[Staffs].[Staff]')
			->where(
				'StaffID',
				'='.
				$userId
			);
	}
}
