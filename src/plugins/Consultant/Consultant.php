<?phpdeclare(strict_types=1);
/**
 * @license MIT
 * @author 
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\User\Consultant;

use EmmetBlue\Core\Builder\BuilderFactory as Builder;
use EmmetBlue\Core\Factory\DatabaseConnectionFactory as DBConnectionFactory;
use EmmetBlue\Core\Builder\QueryBuilder\QueryBuilder as QB;
use EmmetBlue\Core\Exception\SQLException;
use EmmetBlue\Core\Exception\UndefinedValueException;
use EmmetBlue\Core\Session\Session;
use EmmetBlue\Core\Logger\DatabaseLog;
use EmmetBlue\Core\Logger\ErrorLog;
use EmmetBlue\Core\Constant;
use EmmetBlue\plugins\User\Account;
/**
 * Class Consultant
 */
 class Consultant{
 	/**
	*the constructor instantiates once any request is made to this class
	*@param $username, $password;
	*@return user USER_ID if user is logged in
 	*/
 	public function __construct($username, $password)
 	{
 		/**
		*@param $username, $password;
 		*/
 		new Account->login($username, $password)
 	}

	/**
 	*view  entire patient history
	*@param $id
	*@return patient history 
 	*/
	public static function viewPatients()
	{
		$selectBuilder = (new Builder('QueryBuilder', 'Select *'))->getBuilder();
		try
		{
			$selectBuilder
			->from(
				"Patient.Patient");
			$result = (
                    DBConnectionFactory::getConnection()
                    ->query((string)$selectBuilder)
                )->fetchAll(\PDO::FETCH_ASSOC);
			DatabaseLog::log(Session::get('USER_ID'), Constant::_EVENT_SELECT, "Patient","Patient", (string)$selectBuilder);
			if($result)
			{
				return $result;
			}
				throw new UndefinedValueException(
				sprintf(
					"could not return all patient", $result),
					(int)Session::get('USER_ID')
					);
			
		}
		catch (\PDOException $e)
	        {
	            throw new SQLException(sprintf(
	                "A database related error has occurred"
	            ), Constant::UNDEFINED);
	        }
	}
	/**
 	*view a particular patient medication history  with date
	*@param $patientId
	*@return patient medication history 
 	*/
	public static function viewPatientMedicationHistory($patientId)
	{
		return (new Medication::retrieve($patient));
	}
	/**
	* view the nurse details who attended to a patient.
	*for eaxample the nurse wh did vitals on a patient
	*@param $nurseId
	*@return nurse details
	*/
	public static function viewNurseDetails($nurseId)
	 {
			$selectBuilder = (new Builder("QueryBuilder","Select"))->getBuilder();
			try
			{
				$selectBuilder
				->columns("Usename")
				->from("Staff.Staff")
				->where("staffID =".QB::wrapString($nurseId,"'")
					);
				$result = (DBConnectionFactory::getConnection()
					->query((string)$selectBuilder)
					)->fetchAll(\PDO::FETCH_ASSOC);
				DatabaseLog::log(Session::get('USER_ID'), Constant::_EVENT_SELECT, 'Staff','Staff', (string)$selectBuilder
					);
				if ($result)
				{
					# if result was successfully fetched
					return $result;
				}
				throw new UndefinedValueException(
					sprintf("could not return nurse username",
					 $result
					 ),
					(int)Session::get('USER_ID')
					);
			}
			catch(\PDOException $e)
			{
				throw new SQLException("Error Processing Request",
					Constant::UNDEFINED
					);
				
			}
	 }
	/**
	*adds prscription to a patient records
	*@param String $parameters
	*/
	public static function addPrescription(...$parameters)
	 {

	 }
	 /**
	* view  patient prescription
	*@param $patientId
	 */
	public static function viewPatientprescription($patientId)
	{

	}
	 /**
	}
	}
	* adds consultant report to the patient records
	*@param $tring $parameter
	 */
	public static function addConsultantReport(...$parameters)
	 {

	 }
	 /**
	*edit patient prescription added by this particular consultant
	*@param $id
	*@return patient prescription for editing
	 */
	public static function editPatientPrescription($id)
	{

	}
	 /**
	*edit patient record added by this particular consultant
	*@param $id
	*@return patient record for editing
	 */
	public static function editPatientPrescription($id)
	{

	}

	public static function consultantNames($id)
	{

	}
	/* patient Diagnostic report*/
	public static function addDiagnosticReport()
	{

	}

	public static function viewDiagnosticReport($id)
	{

	}




 }