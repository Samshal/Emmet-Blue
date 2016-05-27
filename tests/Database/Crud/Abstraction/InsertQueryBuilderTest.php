<?php
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */

 namespace EmmetBlue\Test\Database\Crud\Abstraction;

/**
 * class QueryBuilderTest.
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 * @since v0.0.1 27/05/2016 14:27
 */
 class InsertQueryBuilderTest extends \PHPUnit_Framework_TestCase
 {
 	public function testInsertBuilderActuallyBuilding()
 	{
 		$queryBuilder = new \EmmetBlue\Database\Crud\Abstraction\InsertQueryBuilder("tbl_name");

 		$builtQuery = (string)$queryBuilder;
 		$expectedQuery = "INSERT INTO tbl_name";

 		$this->assertEquals($expectedQuery, $builtQuery);
 	}
 }