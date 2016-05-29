<?php

/**
*  SelectQueryBuilder which handles all  select queries
* @since V 0.0.1 26.05.2016 04:56pm
* @author Ahead!! <flashup4all@gmail.com>
* @license MIT
*
**/
namespace EmmetBlue\Core\Database\Crud\Abstraction;

class DeleteQueryBuilder extends QueryBuilder
{
	/**
	 *@var $selectOptions
	 **/
	private $queryBuilder;
	private $row;

	/**
	 *  constructor
	 * @since V 0.0.1 26.05.2016 04:56pm
	 * @author Bardeson Lucky <Ahead!!> <flashup4all@gmail.com>
	 * @license MIT
	 *
	 **/
	public function __construct(string $tableName = null)
	{
		$deleteKeyword = (is_null($tableName)) ? "DELETE" : "DELETE FROM".$tableName;
		$this->queryBuilder = parent::build($deleteKeyword);
	}
	/**
	 * from() for handling the table where data should be deleted
	 **/
	public function from($tableName)
	{
		$fromKeyword = "FROM".$tableName;
		return $this->tableName = $tableName;
	}
	/**
<<<<<<< HEAD:src/Database/Crud/Abstraction/deleteQueryBuilder.php
	* delete() for handling row to be deleted
	**/
	/*public function delete($row)
=======
	 * delete() for handling row to be deleted
	 **/
	public function delete($row)
>>>>>>> 9de4ac67adcb005fceeeee4b75cc505e0358a4f1:src/Core/Database/Abstraction/deleteQueryBuilder.php
	{
		return $this->row = $row;
	}*/

	/**
<<<<<<< HEAD:src/Database/Crud/Abstraction/deleteQueryBuilder.php
	*where() for conditions to follow before deleting
	**/
	public function where(string $expression)
=======
	 *where() for conditions to follow before deleting
	 **/
	public function where($columnName, $whereOption)
>>>>>>> 9de4ac67adcb005fceeeee4b75cc505e0358a4f1:src/Core/Database/Abstraction/deleteQueryBuilder.php
	{
		$whereKeyword = "WHERE ". $expression;
		return $whereKeyword;
	}

	/**
<<<<<<< HEAD:src/Database/Crud/Abstraction/deleteQueryBuilder.php
	* andWhere() function for deleting with conditions
	**/
	public function andWhere(string $expression)
=======
	 * andWhere() function for deleting with conditions
	 **/
	public function andWhere($columnName, $whereOption)
>>>>>>> 9de4ac67adcb005fceeeee4b75cc505e0358a4f1:src/Core/Database/Abstraction/deleteQueryBuilder.php
	{
		$andWhereKeyword = "AND ".self::where($expression);
		return $andWhereKeyword;
	}
	/**
	 *orWhere() function for handling OR conditions before deleting;
	 **/
	public function orWhere($columnName, $whereOption)
	{
		$orWhereKeyword = "OR ".self::where($expression);
		
		return $orWhereKeyword;
	}
}
