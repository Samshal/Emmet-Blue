<?php
require __DIR__."/vendor/autoload.php";

$qb = new \EmmetBlue\Database\Crud\Abstraction\InsertQueryBuilder();

$qb = $qb->into("students");

$qb = $qb->values([["Samuel", "Adeshina"], ["John", "Doe"], ["Amos", 12]]);
echo (string)$qb;