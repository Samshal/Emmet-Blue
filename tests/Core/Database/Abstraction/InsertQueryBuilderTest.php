<?php

 /**
  * @license MIT
  * @author Samuel Adeshina <samueladeshina73@gmail.com>
  *
  * This file is part of the EmmetBlue project, please read the license document
  * available in the root level of the project
  */
namespace EmmetBlue\Test\Core\Database\Abstraction;

use EmmetBlue\Core\Database\Abstraction\InsertQueryBuilder;

/**
  * class QueryBuilderTest.
  *
  * @author Samuel Adeshina <samueladeshina73@gmail.com>
  *
  * @since v0.0.1 27/05/2016 14:27
  */
 class InsertQueryBuilderTest extends \PHPUnit_Framework_TestCase
 {
     public function testInsertBuilderWithOnlyConstructorParameter()
     {
         $queryBuilder = new InsertQueryBuilder('tbl_name');

         $builtQuery = (string) $queryBuilder;
         $expectedQuery = 'INSERT INTO tbl_name';

         $this->assertEquals($expectedQuery, $builtQuery);
     }

     public function testInsertBuilderWithIntoMethod()
     {
         $queryBuilder = new InsertQueryBuilder();
         $queryBuilder = $queryBuilder->into('tbl_name');

         $builtQuery = (string) $queryBuilder;
         $expectedQuery = 'INSERT INTO tbl_name';

         $this->assertEquals($expectedQuery, $builtQuery);
     }

     public function testInsertBuilderWithIntoAndTableColumnsMethod()
     {
         $queryBuilder = new InsertQueryBuilder();
         $queryBuilder = $queryBuilder->into('tbl_name', ['tbl_col1', 'tbl_col2']);

         $builtQuery = (string) $queryBuilder;
         $expectedQuery = 'INSERT INTO tbl_name(tbl_col1,tbl_col2)';

         $this->assertEquals($expectedQuery, $builtQuery);
     }

     public function testInsertBuilderWithConstructorParameterAndValuesKeyword()
     {
         $queryBuilder = new InsertQueryBuilder('tbl_name');
         $queryBuilder = $queryBuilder->values(['tbl_col_val1', 'tbl_col_val2']);

         $expectedQuery = 'INSERT INTO tbl_name VALUES (tbl_col_val1,tbl_col_val2)';
         $builtQuery = (string) $queryBuilder;

         $this->assertEquals($expectedQuery, $builtQuery);
     }
 }
