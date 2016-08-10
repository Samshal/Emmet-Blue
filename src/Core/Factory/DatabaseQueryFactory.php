<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Core\Factory;

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
 * Class DatabaseQueryFactory.
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since v0.0.1 08/06/2016 14:20
 */
class DatabaseQueryFactory
{
    public static function insert(string $table, array $data)
    {
        $insertBuilder = (new Builder("QueryBuilder","Insert"))->getBuilder();
        $columns = [];
        $values = [];

        foreach ($data as $index=>$datum)
        {
            $columns[] = $index;
            $values[] = $datum;
        }

        $columns = "(".implode(", ", $columns).")";
        $values = "(".implode(", ", $values).")";
        $insertBuilder->into($table.$columns);

        $query = (string)$insertBuilder." VALUES ".$values;
        try
        {
            $parts = explode(".", $table);
            $schemaName = $parts[0];
            $tableName = $parts[1];

            $connection = DBConnectionFactory::getConnection();

            $result = $connection->prepare((string)$query)->execute();

            DatabaseLog::log(Session::get('USER_ID'), Constant::EVENT_INSERT, $schemaName, $tableName, $query);

            $lastInsertId = ($connection->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int) as id")->fetchColumn());

            return [$result, "lastInsertId"=>$lastInsertId];
        }
        catch (\PDOException $e)
        {
            throw new SQLException(sprintf(
                "%s",
                $e->getMessage()
            ), Constant::UNDEFINED);
        }
    }
}