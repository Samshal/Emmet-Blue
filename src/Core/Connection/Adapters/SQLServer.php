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
 * @since v0.0.1 08/06/2016 14:20
 */
class SQlServer implements ConnectableInterface
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
     * MSSQl Server DSN Structure: sqlsrv:Server={srv};Database={db}"
     * `$dsnArray[0] = {srv}`
     * `$dsnArray[1] = {db}`
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
     * Establishes connection
     *
     * @param string $username
     * @param string $password optional
     * @throws \EmmetBlue\Core\Exception\SQLException
     * @return void
     */
    public function connect(string $username, string $password="")
    {
        $server = $this->dsn[0];
        $database = $this->dsn[1];

        $this->loginData['username'] = $username;
        $this->loginData['password'] = $password;

        try
        {
            $this->connectionObject = new \PDO("sqlsrv:Server=$server;Database=$database;ConnectionPooling=0", $username, $password);
        }
        catch (\PDOException $e)
        {
            throw new SQLException("Unable to connect to database", 400, $e);  
        }

        $dsn = $this->dsn;
        unset($dsn[0], $dsn[1]);
        
        foreach ($dsn as $attribute)
        {
            foreach ($attribute as $key=>$value)
            {
                $this->connectionObject->setAttribute($key, $value);
            }
        }
    }

    /**
     * Returns an instance a pdo intance of the connection object
     *
     * @return \PDO
     */
    public function getConnection() : \PDO
    {
        if ($this->connectionObject instanceof \PDO)
        {
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
