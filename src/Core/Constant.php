<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Core;

/**
 * Class Events
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since v0.0.1 08/06/2016 14:20
 */
class Constant
{
	/**
	 * 
	 */
    const EVENT_INSERT = 'EVENT: INSERT DML EVENT';
    const EVENT_SELECT = 'EVENT: SELECT DML EVENT';
    const EVENT_UPDATE = 'EVENT: UPDATE DML EVENT';
    const EVENT_DELETE = 'EVENT: DELETE DML EVENT';

    /**
     * Error Numbers
     */
    const ERROR_401 = 'ERROR_401: Resource Inaccessible';
    const ERROR_402 = 'ERROR_402: Resource Requirements Not Met';
    const ERROR_403 = 'ERROR_403: Resource Not Writable';
    const ERROR_404 = 'ERROR_404: Resource Not Found';

    /**
     * Error Severities
     */
    const ERROR_HIGH = 'ERROR_SEVERITY: HIGH';
    const ERROR_LOW = 'ERROR_SEVERITY: LOW';
    const ERROR_NORMAL = 'ERROR_SEVERITY: NORMAL';

    /**
     * 
     */
    const UNDEFINED = 0;
}
