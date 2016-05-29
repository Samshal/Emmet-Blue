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
        return $this->tableName = $tableName;
    }
    /**
    * delete() for handling row to be deleted
    **/
    public function delete($row)
    {
        return $this->row = $row;
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
    public function andWhere($columnName, $whereOption)
    {
        $this->columnName = $columnName;
        $this->whereOption = $whereOption;
        return $columnName.",".$whereOption;
    }
    /**
    *orWhere() function for handling OR conditions before deleting;
    **/
    public function orWhere($columnName, $whereOption)
    {
        $this->columnName = $columnName;
        $this->whereOption = $whereOption;
        return $columnName.",".$whereOption;
    }
}
