<?php

/**
*  SelectQueryBuilder which handles all  select queries
* @since V 0.0.1 26.05.2016 04:56pm
* @author Ahead!! <flashup4all@gmail.com>
* @license MIT
*
**/
namespace EmmetBlue\Database\Crud\Abstraction;

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
		publiic function __construct(string $tableName = null)
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
	*where() for conditions to follow before deleting
	**/
	public function where(string $expression)
	{
		$whereKeyword = "WHERE ". $expression;
		return $whereKeyword;
	}

	/**
	* andWhere() function for deleting with conditions
	**/
	public function andWhere(string $expression)
	{
		$andWhereKeyword = "AND ".self::where($expression);
		return $andWhereKeyword;
	}
	/**
	*orWhere() function for handling OR conditions before deleting;
	**/
	public function orWhere($columnName,$whereOption)
	{
		$orWhereKeyword = "OR ".self::where($expression);
		
		return $orWhereKeyword;
	}

}