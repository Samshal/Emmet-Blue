<?php declare (strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Core\Logger;

use EmmetBlue\Core\Builder\BuilderFactory as Builder;
use EmmetBlue\Core\Factory\DatabaseConnectionFactory as DBConnectionFactory;
use EmmetBlue\Core\Builder\QueryBuilder\QueryBuilder as QB;
use EmmetBlue\Core\Exception\SQLException;

/**
 * Class ErrorLog
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since v0.0.1 08/06/2016 14:20
 */
class ErrorLog implements LogInterface
{
    public static function log(int $databaseUserId, string $errorNumber, string $errorSeverity, string $errorMessage, string $errorObject=null)
    {
        /**
         * For now I am not doing anything with $errorObject yet.
         *
         * As soon as it can be properly serialized for the MSSQL Server db
         * it shall be saved in the database.
         *
         * FUNNY: I'M GONNA INTENTIONALLY LEAVE THIS COMMIT FOR MY AMUSEMENT
         * $errorObject, wasn't the issue. My DB schema was.
         */
        $insertBuilder = (new Builder("QueryBuilder", "Insert"))->getBuilder();

        $insertBuilder
            ->into('
                [Logs].[ErrorLog]
                (
                    ErrorTime,
                    DatabaseUserId,
                    ErrorNumber,
                    ErrorSeverity,
                    ErrorMessage
                )
            ')
            ->values([
                'GETDATE()',
                $databaseUserId,
                QB::wrapString($errorNumber, "'"),
                QB::wrapString($errorSeverity, "'"),
                QB::wrapString($errorMessage, "'")
            ]);
            
        DBConnectionFactory::getConnection()->query((string)$insertBuilder);
    }
}
