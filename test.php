<?php

	require_once "vendor/autoload.php";

	$qb = new EmmetBlue\Database\Crud\Abstraction\QueryBuilder("I am Samuel");

	echo "Hello".(string)$qb;