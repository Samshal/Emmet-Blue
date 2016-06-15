<?php declare (strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Core\Exception;

use EmmetBlue\Core\Constant;

/**
 * class SQLException.
 * Instantiates a new instance of SQLException
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since v0.0.1 08/06/2016 14:20
 */
class SQLException extends Exception
{
    public function __construct(string $message, int $databaseUser)
    {
        parent::__construct($message, 0, null);
        
        $this->log($databaseUser, Constant::ERROR_401, Constant::ERROR_NORMAL);
    }
}
