<?php declare(strict_types=1);

/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */

namespace EmmetBlue\Core\Connection\Adapters;

use ClickHouseDB\Client;
use EmmetBlue\Core\Connection\ConnectableInterface;
use EmmetBlue\Core\Exception\SQLException;

/**
 * class ClickHouse.
 * Instantiates a new instance of ConnectableInterface for ClickHouse
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since v0.0.1 03/12/2024 05:57
 */
class ClickHouse implements ConnectableInterface
{
    /**
     * @var array $dsn
     */
    protected $dsn;

    /**
     * @var Client $connectionObject
     */
    protected $connectionObject;

    /**
     * @var array loginData
     */
    private $loginData = [];

    /**
     * Setter for the DSN array {@see $dsn}
     *
     * ClickHouse DSN Structure: clickhouse:Host={host};Port={port};Database={db}"
     *
     * `$dsnArray[0] = {host}`
     * `$dsnArray[1] = {port}`
     * `$dsnArray[2] = {db}`
     * Attributes = [2 - infinity]
     *
     * @param array $dsnArray
     * @return void
     */
    public function setDsn(array $dsnArray)
    {
        $this->dsn = $dsnArray;
    }

    /**
     * Establishes connection to ClickHouse
     *
     * @param string $username
     * @param string $password optional
     * @throws \EmmetBlue\Core\Exception\SQLException
     * @return void
     */
    public function connect(string $username, string $password = '')
    {
        $host = $this->dsn[0];
        $port = $this->dsn[1];
        $database = $this->dsn[2];

        $this->loginData['username'] = $username;
        $this->loginData['password'] = $password;

        try {
            // Initialize the ClickHouse client
            $this->connectionObject = new Client([
                'host' => $host,
                'port' => $port,
                'username' => $username,
                'password' => $password
            ]);

            $this->connectionObject->database($database);
        } catch (\Exception $e) {
            throw new SQLException('Unable to connect to ClickHouse', 400, $e);
        }
    }

    /**
     * Returns an instance of the ClickHouseDB\Client connection object
     *
     * @return Client
     */
    public function getConnection(): Client
    {
        if ($this->connectionObject instanceof Client) {
            return $this->connectionObject;
        }

        $this->connect(
            $this->loginData['username'] ?? '',
            $this->loginData['password'] ?? ''
        );

        return $this->connectionObject;
    }

    /**
     * Closes connection
     */
    public function disableConnection()
    {
        $this->connectionObject = null;
    }
}
