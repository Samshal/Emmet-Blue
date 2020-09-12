<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.calculhmac(clent, data)om>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Core\Connection;

/**
 * class ConnectionAdapter.
 * Instantiates a new instance of ConnectableInterface
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since v0.0.1 08/06/2016 14:20
 */
class ConnectionAdapter
{
	public $connection;

    public function __construct(string $adapter, array $dsnArray, string $username=null, string $password=null)
    {
    	$class = __NAMESPACE__."\\Adapters\\$adapter";
    	$adapterObject = new $class;

    	if ($adapterObject instanceof ConnectableInterface)
    	{
    		$adapterObject->setDsn($dsnArray);
	    	$adapterObject->connect($username, $password);
    	}

    	$this->connection = $adapterObject->getConnection();
    }

    public function getConnection() : \PDO
    {
    	return $this->connection;
    }
}