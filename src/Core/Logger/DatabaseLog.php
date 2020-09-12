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
 * Class DatabaseLog
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since v0.0.1 08/06/2016 14:20
 */
class DatabaseLog implements LogInterface
{
    public static function logDeprecated(string $databaseUserId, string $event, string $objectSchema, string $object, string $tSql)
    {
        $insertBuilder = (new Builder("QueryBuilder", "Insert"))->getBuilder();
        try {
            $insertBuilder
                ->into('
                    [Logs].[DatabaseLog]
                    (
                        PostTime,
                        DatabaseUserId,
                        Event,
                        ObjectSchema,
                        Object,
                        TSQL
                    )
                ')
                ->values([
                    'GETDATE()',
                    QB::wrapString($databaseUserId, "'"),
                    QB::wrapString((string)$event, "'"),
                    QB::wrapString($objectSchema, "'"),
                    QB::wrapString($object, "'"),
                    QB::wrapString(str_replace("'", "\"", $tSql), "'")
                ]);
            
            DBConnectionFactory::getConnection()->query((string)$insertBuilder);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            throw new SQLException(sprintf(
                    "Unable to store database log"
                ), 1);
        }
    }

    public static function log(string $databaseUserId, string $event, string $objectSchema, string $object, string $tSql){

    }
}
