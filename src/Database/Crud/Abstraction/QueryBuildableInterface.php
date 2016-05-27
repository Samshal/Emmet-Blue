<?php
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */

namespace EmmetBlue\Database\Crud\Abstraction;

/**
 * QueryBuildableInterface contract
 * All classes responsible for query building must
 * implement this interface and every method within it
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 * @since v0.0.1 27/05/2016 13:14
 */
interface QueryBuildableInterface
{

    /**
     * Builds a query object.
     * Must return a string defining an sql statement which
     * must also obey {@see DatabaseQueryableInterface} contract.
     *
     * @throws {@todo Come up with exceptions thrown by this method}
     * @return QueryBuilder;
     */
    public function build(string $sqlStringToAppend);
}
