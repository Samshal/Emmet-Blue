<?php declare(strict_types=1);

/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */

namespace EmmetBlue\Core\Connection;

/**
 * Interface ConnectableInterface.
 * Instantiates a new instance of ConnectableInterface
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since v0.0.1 08/06/2016 14:20
 */
interface ConnectableInterface
{
    /**
     * Setter for the DSN string {@see $dsn}
     *
     * @param array $dsnArray
     * @return void
     */
    public function setDsn(array $dsnArray);

    /**
     * Establishes connection
     *
     * @param string $username optional
     * @param string $password optional
     * @throws [@todo get exceptions]
     * @return void
     */
    public function connect(string $username, string $password = '');

    /**
     * Returns an instance of the connection object
     */
    public function getConnection();

    /**
     * Closes connection
     */
    public function disableConnection();
}
