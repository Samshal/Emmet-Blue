<?php

/**
*  SelectQueryBuilder which handles all  select queries
* @since V 0.0.1 26.05.2016 04:56pm
* @author Ahead!! <flashup4all@gmail.com>
* @license MIT
*
**/

class deleteQueryBuilder
{
	/**
	*@var $selectOptions
	**/
	private $row;

	/**
	*  constructor
	* @since V 0.0.1 26.05.2016 04:56pm
	* @author Ahead!! <flashup4all@gmail.com>
	* @license MIT
	*
	**/
		publiic function __construct()
		{
		
		}
	/**
	* delete() for handling row to be deleted
	**/
	public function delete($row)
	{
		$this->row = $row;
	}
	/**
	* from() for handling the table where data should be deleted
	**/
	public function from($tableName)
	{
		$this->tableName = $tableName;
	}

	/**
	*where() for conditions to follow before deleting
	**/
	public function where($columnName, $whereOption)
	{
		$this->columnName = $columnName;
		$this->whereOption = $whereOption;
		return $columnName."=".$whereOption;
	}

	/**
	* andWhere() function for deleting with conditions
	**/
	public function andWhere($columnName,$whereOption)
	{
		$this->columnName = $columnName;
		$this->whereOption = $whereOption;
		return $columnName.",".$whereOption;
	}
	/**
	*orWhere() function for handling OR conditions before deleting;
	**/
	public function orWhere($columnName,$whereOption)
	{
		$this->columnName = $columnName;
		$this->whereOption = $whereOption;
		return $columnName.",".$whereOption;
	}

}