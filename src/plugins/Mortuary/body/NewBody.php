<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.calculhmac(clent, data)om>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Plugins\Mortuary\Body;

use EmmetBlue\Core\Builder\BuilderFactory as Builder;
use EmmetBlue\Core\Factory\DatabaseConnectionFactory as DBConnectionFactory;
use EmmetBlue\Core\Factory\DatabaseQueryFactory as DatabaseQueryFactory;
use EmmetBlue\Core\Builder\QueryBuilder\QueryBuilder as QB;
use EmmetBlue\Core\Exception\SQLException;
use EmmetBlue\Core\Exception\UndefinedValueException;
use EmmetBlue\Core\Session\Session;
use EmmetBlue\Core\Logger\DatabaseLog;
use EmmetBlue\Core\Logger\ErrorLog;
use EmmetBlue\Core\Constant;

/**
 * class NewBody.
 *
 * NewBody Controller
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 * @since v0.0.1 08/06/2016 14:20
 */
class NewBody
{
	public static function default(array $data)
	{
		$tag = $data['tag'] ?? 'NULL';
		$dateOfDeath = $data['dateOfDeath'] ?? 'NULL';
		$timeOfDeath = $data['timeOfDeath'] ?? 'NULL';
		$placeOfDeath = $data['placeOfDeath'] ?? 'NULL';
		$burialPlace = $data['burialPlace'] ?? 'NULL';
		$physicianName = $data['physicianName'] ?? 'NULL';
		$physicianId = $data['physicianId'] ?? 'NULL';

		$packed = [
			'BodyTag'=>($tag !== 'NULL') ? QB::wrapString($tag, "'") : $tag,
			'DateOfDeath'=>($dateOfDeath !== 'NULL') ? QB::wrapString($dateOfDeath, "'") : $dateOfDeath,
			'TimeOfDeath'=>($timeOfDeath !== 'NULL') ? QB::wrapString($timeOfDeath, "'") : $timeOfDeath,
			'PlaceOfDeath'=>($placeOfDeath !== 'NULL') ? QB::wrapString($placeOfDeath, "'") : $placeOfDeath,
			'BurialPlace'=>($burialPlace !== 'NULL') ? QB::wrapString($burialPlace, "'") : $burialPlace,
			'DeathPhysicianName'=>($physicianName !== 'NULL') ? QB::wrapString($physicianName, "'") : $physicianName,
			'DeathPhysicianID'=>$physicianId
		];

		$result = DatabaseQueryFactory::insert('Mortuary.Body', $packed);
		return $result;
	}

	public static function info(array $data)
	{
		$bodyId = $data['id'] ?? 'NULL';
		$bodyFirstName = $data['firstName'] ?? 'NULL';
		$bodyLastName = $data['lastName'] ?? 'NULL';
		$bodyDateOfBirth = $data['dateOfBirth'] ?? 'NULL';
		$bodyGender = $data['gender'] ?? 'NULL';
		$bodyPlaceOfBirth = $data['placeOfBirth'] ?? 'NULL';
		$familyMemberRelationshipType = $data['familyMemberRelationshipType'] ?? 'NULL';
		$familyMemberName = $data['familyMemberName'] ?? 'NULL';
		$familyMemberPhoneNumber = $data['familyMemberPhoneNumber'] ?? 'NULL';

		$packed = [
			'BodyID'=>$bodyId,
			'BodyFirstName'=>($bodyFirstName !== 'NULL') ? QB::wrapString($bodyFirstName, "'") : $bodyFirstName,
			'BodyLastName'=>($bodyLastName !== 'NULL') ? QB::wrapString($bodyLastName, "'") : $bodyLastName,
			'BodyDateOfBirth'=>($bodyDateOfBirth !== 'NULL') ? QB::wrapString($bodyDateOfBirth, "'") : $bodyDateOfBirth,
			'BodyGender'=>($bodyGender !== 'NULL') ? QB::wrapString($bodyGender, "'") : $bodyGender,
			'BodyPlaceOfBirth'=>($bodyPlaceOfBirth !== 'NULL') ? QB::wrapString($bodyPlaceOfBirth, "'") : $bodyPlaceOfBirth,
			'FamilyMemberRelationshipType'=>($familyMemberRelationshipType !== 'NULL') ? QB::wrapString($familyMemberRelationshipType, "'") : $familyMemberRelationshipType,
			'FamilyMemberName'=>($familyMemberName !== 'NULL') ? QB::wrapString($familyMemberName, "'") : $familyMemberName,
			'FamilyMemberPhoneNumber'=>($familyMemberPhoneNumber !== 'NULL') ? QB::wrapString($familyMemberPhoneNumber, "'") : $familyMemberPhoneNumber
		];

		$result = DatabaseQueryFactory::insert('Mortuary.BodyInformation', $packed);
		return $result;
	}
}