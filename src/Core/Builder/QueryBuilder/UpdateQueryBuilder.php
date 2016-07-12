<?php declare (strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 */
namespace EmmetBlue\Core\Builder\QueryBuilder;

/**
 * class UpdateQueryBuilder.
 * Builds an Update query.
 *
 * {@see QueryBuilder}
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since 28/05/2016
 */
class UpdateQueryBuilder extends QueryBuilder
{
    /**
     * @var \EmmetBlue\Core\Builder\QueryBuilder
     */
    protected $queryBuilder;

    /**
     * @param string|null $tableName
     */
    public function __construct(string $tableName = null)
    {
        $updateKeyword = (is_null($tableName)) ? 'UPDATE' : 'UPDATE '.$tableName;
        $this->queryBuilder = $this->build($updateKeyword);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $tableName
     *
     * @return \EmmetBlue\Core\Builder\UpdateQueryBuilder
     */
    public function table(string $tableName)
    {
        $this->queryBuilder = $this->queryBuilder->build($tableName);

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @param string[] $inputValues
     *
     * @return \EmmetBlue\Core\Builder\UpdateQueryBuilder
     */
    public function set(array $inputValues)
    {
        $valuesKeyword = 'SET ';

        $valuesKeyword .= self::getImplodedStringWithKeys($inputValues);

        $this->queryBuilder = $this->queryBuilder->build($valuesKeyword);

        return $this;
    }
}
