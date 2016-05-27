<?php
/**
 * @license MIT
 * @author Chukwuma Nwali <chukznwali@gmail.com>
 */

namespace EmmetBlue\Database\Crud\Abstraction;

/**
 * This InsertQueryBuilder class that
 */
class InsertQueryBuilder extends QueryBuilder
{
    private $queryBuilder;
    public function __construct(string $tableName = null)
    {
        $insertKeyword = (!is_null($tableName)) ? "INSERT" : "INSERT INTO ".$tableName;
        $this->queryBuilder = parent::build($insertKeyword);
    }

    public function into(string $tableName)
    {
        $intoKeyword = "INTO ".$tableName;
        $this->queryBuilder->build($intoKeyword);

        return new self;
    }
}
