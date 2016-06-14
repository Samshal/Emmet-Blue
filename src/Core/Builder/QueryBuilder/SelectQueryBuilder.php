<?php declare (strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 */
namespace EmmetBlue\Core\Builder\QueryBuilder;

/**
 * class SelectQueryBuilder.
 * Builds an Select query.
 *
 * {@see QueryBuilder}
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since 28/05/2016
 */
class SelectQueryBuilder extends QueryBuilder
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
        $SelectKeyword = "SELECT";
        $this->queryBuilder = $this->build($SelectKeyword);
    }

    /**
     * {@inheritdoc}
     *
     * @param int $topValue
     *
     * @return \EmmetBlue\Core\Builder\SelectQueryBuilder
     */
    public function top(int $topValue)
    {
        $this->queryBuilder = $this->queryBuilder->build("TOP ".$topValue);

        return $this;
    }
    /**
    * This method handles situations that requires to
    * select all from the table.
    * @param *
    */
    public function all()
    {
     $this->queryBuilder = $this->queryBuilder->build("*");
     return $this;  
    }
    /**
     * {@inheritdoc}
     *
     * @param string $columns
     *
     * @return \EmmetBlue\Core\Builder\SelectQueryBuilder
     */
    public function columns(string ...$columns)
    {
        $this->queryBuilder = $this->queryBuilder->build(self::getImplodedString($columns));

        return $this;
    }

     /**
     * {@inheritdoc}
     *
     * @param string $tableName
     *
     * @return \EmmetBlue\Core\Builder\SelectQueryBuilder
     */
    public function from(string $tableName)
    {
        $this->queryBuilder = $this->queryBuilder->build("FROM ".$tableName);

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @param string $tableName
     * @param string $condition
     *
     * @return \EmmetBlue\Core\Builder\SelectQueryBuilder
     */
    public function innerJoin(string $tableName, string $condition)
    {
        $string = "INNER JOIN ".$tableName." ON ".$condition;
        $this->queryBuilder = $this->queryBuilder->build($string);

        return $this;
    }

}
