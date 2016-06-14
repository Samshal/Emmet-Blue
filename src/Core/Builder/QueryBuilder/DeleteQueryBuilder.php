<?php declare (strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 */
namespace EmmetBlue\Core\Builder\QueryBuilder;

/**
 * class DeleteQueryBuilder.
 * Builds an Delete query.
 *
 * {@see QueryBuilder}
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since 28/05/2016
 */
class DeleteQueryBuilder extends QueryBuilder
{
    /**
     * @var \EmmetBlue\Core\Builder\QueryBuilder
     */
    protected $queryBuilder;

    /**
     * @param string|null $tableName
     */
    public function __construct()
    {
        $DeleteKeyword = "Delete";
        $this->queryBuilder = $this->build($DeleteKeyword);
    }

     /**
     * {@inheritdoc}
     *
     * @param string $tableName
     *
     * @return \EmmetBlue\Core\Builder\DeleteQueryBuilder
     */
    public function from(string $tableName)
    {
        $this->queryBuilder = $this->queryBuilder->build("FROM ".$tableName);

        return $this;
    }

    public function where(string $argument){
     $wherekeyword = "WHERE";   
    $this->queryBuilder = $this->queryBuilder->build($wherekeyword($argument));
    return $this;

    }
}
