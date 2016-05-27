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
 * class QueryBuilder.
 * Implements the QueryBuildableInterface contract {@see QueryBuildableInterface}
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 * @since v0.0.1 27/05/2016 13:35
 */
class QueryBuilder implements QueryBuildableInterface
{

	/**
	 * @var string $sqlStatement Global Sql Statement
	 */
	$sqlStatement;

	/**
	 * @var string SPACE
	 */
	const SPACE = " ";

	/**
	 * @param string | null $sqlStatement SQL Statement to be processed by the build method
	 * @throws {@todo Write exception class}
	 */
	public function __construct(\String $sqlStatement = null)
	{
		$this->sqlStatement = $sqlStatement;
	}

	/**
	 * Returns the string value of the global sqlStatement variable
	 *
	 * @return string
	 */
	private function getSqlStatement()
	{
		return $this->sqlStatement;
	}

	/**
	 * Sets/Modifies the value of the global sqlStatement variable
	 *
	 * @param string $sqlStatement to set/replace global equivalent to.
	 * @return null;
	 */
	private function setSqlStatement(\String $sqlStatement) : null
	{
		$this->sqlStatement = $sqlStatement;

		return;
	}

	/**
	 * Builds a QueryBuilder object.
	 * {@see QueryBuildableInterface}
	 *
	 * @param string | null $sqlStringToAppend
	 * @throws {@todo Create exceptions}
	 * @return QueryBuilder new instance of the QueryBuilder object.
	 */
	public function build(\String $sqlStringToAppend) : QueryBuilder
	{
		$newSqlString = self::getSqlStatement().SPACE.$sqlStringToAppend;
		self::setSqlStatement($newSqlString);

		return new QueryBuilder(self::getSqlStatement());
	}

	/**
	 * returns a `built sql` when the QueryBuilder object is casted to a string.
	 *
	 * @return string
	 */
	public function __toString()
	{
		return new getSqlStatement();
	}
}