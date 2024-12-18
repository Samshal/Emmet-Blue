<?php declare(strict_types=1);

/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */

namespace EmmetBlue\Core\Connection\Adapters;

use EmmetBlue\Core\Connection\ConnectableInterface;
use EmmetBlue\Core\Exception\SQLException;

/**
 * class ConnectionAdapter.
 * Instantiates a new instance of ConnectableInterface
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since v0.0.1 13/12/2024 15:01
 */
class PostgreSQL implements ConnectableInterface
{
    /**
     * @var string $dsn
     */
    protected $dsn;

    /**
     * @var \PDO $connectionObject
     */
    protected $connectionObject;

    /**
     * @var array loginData
     */
    private $loginData = [];

    /**
     * Setter for the DSN string {@see $dsn}
     *
     * @param array $dsnArray
     * @return void
     */
    public function setDsn(array $dsnArray)
    {
        $this->dsn = $dsnArray;
    }

    /**
     * Establishes connection
     *
     * @param string $username
     * @param string $password optional
     * @throws \EmmetBlue\Core\Exception\SQLException
     * @return void
     */
    public function connect(string $username, string $password = '')
    {
        $server = explode(':', $this->dsn[0]);
        $database = $this->dsn[1];

        $host = $server[0];
        $port = $server[1];

        $this->loginData['username'] = $username;
        $this->loginData['password'] = $password;

        try {
            $this->connectionObject = new \PDO("pgsql:host=$host;port=$port;dbname=$database;", $username, $password);
        } catch (\PDOException $e) {
            throw new SQLException('Unable to connect to database', 400, $e);
        }

        $dsn = $this->dsn;
        unset($dsn[0], $dsn[1]);

        foreach ($dsn as $attribute) {
            foreach ($attribute as $key => $value) {
                $this->connectionObject->setAttribute($key, $value);
            }
        }
    }

    /**
     * Returns an instance a pdo intance of the connection object
     *
     * @return \PDO
     */
    public function getConnection(): \PDO
    {
        if ($this->connectionObject instanceof \PDO) {
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

    /**
     * Sets attributes for the PDO object
     *
     * @param \PDO $attribute
     * @param \PDO $value
     */
    public function setAttribute(\PDO $attribute, \PDO $value)
    {
        $this->connectionObject->setAttribute($attribute, $value);
    }
}
