<?php
/**
 * @license MIT
 * @author Chukwuma Nwali <chukznwali@gmail.com>
 */

namespace EmmetBlue\Database\Crud\Abstraction;

   /**
   *This InsertQueryBuilder class that
   */

class InsertQueryBuilder {

/** 
* @param Sets the table name to be inserted into.
*/  

 private $tableName;
 
 /**
 * The Into method accepts the table name to be inserted  into.
 */

public function into($tableName){
	
    $this->tableName = $tableName;

   return $tableName;
      
}

/**
  * The contructor method takes in the table name
  ** that is to be inserted into table  
  * class is instantiated.
  */
public function __contructor( $tableName = null){
    
    	self::into($tableName);
     
     }
          
	

 /**
 * The columns method accepts the number of columns 
 * and returns it as an array.
 */
public function Columns(...$tableColumns){

     $this->$tableColumns = $tableColumns;

     return $tableColumns; 

}
/**
* The values method accepts the values to
* inserted into the table and returns 
* the values in arrary form.
*/

public function values(...$tableValues){

 	$this->$tableValues = $tableValues;

 	return $tableValues;
}




}


