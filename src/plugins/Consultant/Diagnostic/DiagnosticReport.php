<?php
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
 * Class Diagnostic Report
 *this class manages all diagnostic report of a patient
 */
 class DiagnosticReport
 {
     /**
    *the constructor instantiates once any request is made to this class
    *@param 
    *@return 
    */
    public function __construct()
    {
    }
     public static function create(array $array)
     {
     }

     public static function store()
     {
     }

     public static function retrieve($patientID)
     {
     }

     public static function edit($id)
     {
     }

     public static function update()
     {
     }

     public static function delete()
     {
     }
 }
