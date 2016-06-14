<?phpdeclare(strict_types=1);
/**
 * @license MIT
 * @author 
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\Mortuary;

use EmmetBlue\Core\Builder\BuilderFactory as Builder;
use EmmetBlue\Core\Factory\DatabaseConnectionFactory as DBConnectionFactory;
use EmmetBlue\Core\Builder\QueryBuilder\QueryBuilder as QB;
use EmmetBlue\Core\Exception\SQLException;
use EmmetBlue\Core\Exception\UndefinedValueException;
use EmmetBlue\Core\Session\Session;
use EmmetBlue\Core\Logger\DatabaseLog;
use EmmetBlue\Core\Logger\ErrorLog;
use EmmetBlue\Core\Constant;
use EmmetBlue\Plugins\User\Account;
/**
 * Class DatabaseLog
 *
 *
 * @since v0.0.1 08/06/2016 14:20
 *
 * @param username
 * @param passsword
 */
 public $username; // The user mane for the user.
 public $password: // The password for the user.

class Mortuary 
 { 

public function __construct($username, $password){
 		new Account->login($username, $password);
 	 }
/**
* The depositBody methos takes in the
* necesaary details about the corpse
* and stores ir in the database.
*/
public static function depositBody($name, $sex, $contacts, $nextofkin){
 $insertBuilder = (new Builder("QueryBuilder","Insert"))->getBuilder();
 try {
 $insertBuilder
 ->into("Staffs.Department", ['name', 'sex', 'contacts'. 'nextofkin']
 	)
 ->values($name, $sex, $contacts, $nextofkin);
 	
 	$result = (DBConnectionFactory::getConnection()
        	 	->query((string)$insertBuilder)); 

 DatabaseLog::log(Session::get('USER_ID'), Constant::EVENT_INSERT, 'Staffs', 'Department', (string)$insertBuilder);

// if the body deposoited successfully return true
 	if(isset($result)){
 	return true;
 }
 	}
 catch (\PDOException $e)
        {
         throw new SQLException(sprintf(
          "Unable to insert records"
          ), Constant::UNDEFINED);
       }
}
/**
* This method removes tor deletes the body from the
* mortuary table
*/
public static function removeBody($id){
$deletetBuilder =(new Builder("QueryBuilder", "delete"))->getBuilder();
	try{
		$deleteBuilder
		->from("Staffs.Department")
		->where(id = $id);
		$result = (DBConnectionFactory::getConnection()
        	 	->query((string)$deleteBuilder)); 

DatabaseLog::log(Session::get('USER_ID'), Constant::EVENT_INSERT, 'Staffs', 'Department', (string)$insertBuilder);

// if  deleted successfully return true
if(isset($result)){
	return true;
}
	}
catch (\PDOException $e)
        {
         throw new SQLException(sprintf(
          "Unable to remove records"
          ), Constant::UNDEFINED);
       }

}
public static function viewAllBody(){
$selectBuilder =(new Builder("QueryBuilder", "select"))->getBuilder();
	try{
		$selectBuilder
		->all()
		->from("Staffs.department");
		$result = (DBConnectionFactory::getConnection()
        	 	->query((string)$selectBuilder));
		
DatabaseLog::log(Session::get('USER_ID'), Constant::EVENT_SELECT, 'Staffs', 'Staff', (string)$selectBuilder); 
	}



}
public static function viewSingleBody($id){


}

 	 }