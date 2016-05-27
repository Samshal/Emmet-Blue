<?php
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshia73@gmail.com>, Chukwuma Nwali <chukznwali@gmail.com>
 */

namespace EmmetBlue\Database\Crud;

/**
  * This interface will be used to manipulate our database interactions/operations
 */
interface DatabaseManipulatableInterface
{

    /**
     *The setData method collects the data to be manipulated in the database.
     *
     * @return void;
     */
	public function setData();

	/**
	 * The CrudAction method performs either create, retrieve, update
	 * or delete actions to data in the database.
	 */
	public function crudAction();

	/**
	 * The getResponse method returns the result of 
	 * the crudAction method.
	 */
	public function getResponse();
}
