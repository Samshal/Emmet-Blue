<?php
require __DIR__."/vendor/autoload.php";

$qb = new \EmmetBlue\Database\Crud\Abstraction\InsertQueryBuilder("students");

//$qb = $qb->into("students");

echo (string)$qb;