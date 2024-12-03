<?php declare(strict_types=1);

/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */

namespace EmmetBlue\Core\Factory;

use EmmetBlue\Core\Connection\Adapters\ClickHouse as ClickHouseConnection;
use EmmetBlue\Core\Connection\ConnectionAdapter as Connection;
use EmmetBlue\Core\Constant;

/**
 * Class DatabaseConnectionFactory.
 * Instantiates a new instance of ConnectableInterface
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since v0.0.1 08/06/2016 14:20
 */
class DatabaseConnectionFactory
{
    /**
     * @var \PDO $connectionObject
     */
    private static $connectionObject;

    /**
     * Gets the config values defined in the database-config.json file
     * and uses the values to create a new connection object.
     */
    public static function bootstrap($config = 'globals.json', $configPath = 'config-dir/database-config')
    {
        $configPaths = explode('/', $configPath);
        $databaseConfigJson = file_get_contents(Constant::getGlobals($config)[$configPaths[0]][$configPaths[1]]);

        $databaseConfig = json_decode($databaseConfigJson);

        $adapter = $databaseConfig->adapter;
        $server = $databaseConfig->server;
        $database = $databaseConfig->database;
        $username = $databaseConfig->username;
        $password = $databaseConfig->password;

        if ($adapter == 'ClickHouse') {
            $adapterObject = new ClickHouseConnection();
            $serverArr = explode(':', $server);
            $adapterObject->setDsn([$serverArr[0], $serverArr[1], $database]);
            $adapterObject->connect($username, $password);

            self::$connectionObject = $adapterObject;
        } else {
            self::$connectionObject = new Connection($adapter, [$server, $database], $username, $password);

            if ($databaseConfig->showError) {
                self::$connectionObject->getConnection()->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }
        }
    }

    /**
     * Returns a new connection object
     *
     * @return \PDO
     */
    public static function getConnection($config = 'globals.json'): \PDO
    {
        self::bootstrap($config);
        return self::$connectionObject->getConnection();
    }
}
