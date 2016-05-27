<?php
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 */

Namespace EmmetBlue\Database\Crud\Abstraction;

/**
 * QueryBuildableInterface contract
 * All classes responsible for QueryBuild{ing} must
 * implement this interface and every method within it
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 * @since v0.0.1 <27/05/2016 13:14>
 */
interface QueryBuildableInterface {

    /**
     * Builds a query object.
     * Must return a string defining an sql statement which
     * must also obey {@see DatabaseQueryableInterface} contract.
     *
     * @throws {@todo Come up with exceptions thrown by this method}
     * @return string;
     */
    public function build();
}
