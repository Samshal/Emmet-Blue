<?php
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Tests\Core\Database\Abstraction;

use EmmetBlue\Core\Builder\QueryBuilder\QueryBuilder;

/**
  * class QueryBuilderTest.
  *
  * @author Samuel Adeshina <samueladeshina73@gmail.com>
  *
  * @since v0.0.1 27/05/2016 14:27
  */
 class QueryBuilderTest extends \PHPUnit\Framework\TestCase
 {
     public function testBuilderActuallyBuilding()
     {
         $queryBuilder = new QueryBuilder('INSERT INTO tbl_name');
         $queryBuilder = $queryBuilder->build("VALUES ('tbl_col1', 'tbl_col2')");

         $builtQuery = (string) $queryBuilder;
         $expectedQuery = "INSERT INTO tbl_name VALUES ('tbl_col1', 'tbl_col2')";

         $this->assertEquals($expectedQuery, $builtQuery);
     }

     public function testWrapStringFunctionBehavesStatically()
     {
         $built = QueryBuilder::wrapString('Name', "'");
     }
 }
