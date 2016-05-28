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
 	public function testInsertBuilderWithOnlyConstructorParameter()
 	{
 		$queryBuilder = new \EmmetBlue\Database\Crud\Abstraction\InsertQueryBuilder("tbl_name");

 		$builtQuery = (string)$queryBuilder;
 		$expectedQuery = "INSERT INTO tbl_name";

 		$this->assertEquals($expectedQuery, $builtQuery);
 	}

 	public function testInsertBuilderWithIntoMethod(){
 		$queryBuilder = new \EmmetBlue\Database\Crud\Abstraction\InsertQueryBuilder();
 		$queryBuilder = $queryBuilder->into("tbl_name");

 		$builtQuery = (string)$queryBuilder;
 		$expectedQuery = "INSERT INTO tbl_name";

 		$this->assertEquals($expectedQuery, $builtQuery);
 	}

 	public function testInsertBuilderWithIntoAndTableColumnsMethod(){
 		$queryBuilder = new \EmmetBlue\Database\Crud\Abstraction\InsertQueryBuilder();
 		$queryBuilder = $queryBuilder->into("tbl_name", ["tbl_col1", "tbl_col2"]);

 		$builtQuery = (string)$queryBuilder;
 		$expectedQuery = "INSERT INTO tbl_name(tbl_col2, tbl_col2)";

 		$this->assertEquals($expectedQuery, $builtQuery);
 	}
 }