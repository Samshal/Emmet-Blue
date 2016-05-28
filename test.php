<?php
require __DIR__."/vendor/autoload.php";

use \EmmetBlue\Database\Crud\Abstraction\InsertQueryBuilder;
$qb = new InsertQueryBuilder();

$qb = $qb->into("students", ["firstname", "lastname"])->values([[InsertQueryBuilder::wrapString("Samuel", "'"), "Adeshina"], ["John", "Doe"], ["Amos", 12]]);
echo $qb;