<?php
/**
 * @license MIT
 * @author Chukwuma Nwali <chukznwali@gmail.com>
 */

namespace EmmetBlue\Database\Crud\Abstraction;

   /**
   *This UpdateQueryBuilder class that
   */

class UpdatetQueryBuilder extends QueryBuilder {

/** 
* @param Sets the table name to be updated.
*/  
 private $tableName;
 /**
 * The Into method sets the table name to be updated  into.
 */
public function setTableName($tableName){
	
    $this->tableName = $tableName;
   return $tableName;  
}

/**
  * The contructor method takes in the table name
  ** that is to be updated into table  when the
  * UpdateQueryBuider class is instantiiated.
  * 
 */
public function __construct( $tableName = null){

  if((!is_null($tableName))){
  return $updateKeyword = "UPDATE".$tableName." SET";
      }  
    }
/**
* The update method accepts a table name appended to
* UPDATE clause and SET clause appended to table name.
*/
    
public function tableName($tableName){
    $updateKeyword = "UPDATE ".$tableName." SET";
   return $updateKeyword;
}

/**
  * The method setValues accepts the values to be
   * updated against the setColumnsmethod
  */
public function set(array $updateValues = []){

$updateKeyword = $this->tableName($tableName);
         
if(is_array($updateValues[0])){
  $tempValuesKeywords = [];
  foreach ($updateValues as $updateValue){
     
  $tempValuesKeywords[] = $this->wrapString(self::getImplodedString($updateValues), '(', ')');        }
}
  return $updateKeyword .= self::getImplodedString($tempValuesKeywords);
  unset($tempValuesKeywords);
    }
/**
* The where method accepts an expression, an
*  sql and returns it and appends it to a WHERE clause.
* 
*/
public function where(string $expression){
  $whereKeywoed = "WHERE";
  if(!empty($expression))
  return $whereKeyword .= $this->wrapString($expression, '(', ')');
   }
}
/** The andWhere method accepts an expression and returns
*  it appended to an AND clause.
*
*/
public function andWhere(string $expression){
  $andKeyword ="AND";
  if(!empty($expression)
  {
  return $andKeyword .= $this->wrapString($expression, '(', ')');
  }
}
/** The orWhere method accepts an expression and returns the expression
* appended to an OR clause.
*/
public function orWhere(string $expression){
  $orKeyword = "OR";

  if(!empty($expreeeion)
  {
  return $orKeyword .= $this->wrapString($expression, '(', ')');
  }

}


