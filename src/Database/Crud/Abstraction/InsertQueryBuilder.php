<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Chukwuma Nwali <chukznwali@gmail.com>
 */

namespace EmmetBlue\Database\Crud\Abstraction;

/**
 * class InsertQueryBuilder. 
 * Builds an insert query.
 *
 * {@see QueryBuilder}
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 * @since 28/05/2016
 */
class InsertQueryBuilder extends QueryBuilder
{
    /**
     * @var \EmmetBlue\Database\Crud\Abstraction\QueryBuilder $queryBuilder
     * @access private
     */
    private $queryBuilder;

    /**
     * @param string|null $tableName
     */
    public function __construct(string $tableName = null)
    {
        $insertKeyword = (is_null($tableName)) ? "INSERT" : "INSERT INTO ".$tableName;
        $this->queryBuilder = parent::build($insertKeyword);
    }

    /**
     * {@inheritdoc}
     * 
     * @param string $tableName
     * @param array $tableColumns Optional, provide this to specify the 
     * columns that should be acted on
     * @access public
     * @return \EmmetBlue\Database\Crud\Abstraction\InsertQueryBuilder
     */
    public function into(string $tableName, array $tableColumns = [])
    {
        $intoKeyword = "INTO ".$tableName;

        if (!empty($tableColumns))
        {
            $intoKeyword .= '('.self::getImplodedString($tableColumns).')';
        }

        $this->queryBuilder = $this->queryBuilder->build($intoKeyword);

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @param array $inputValues
     * @access public
     * @return \EmmetBlue\Database\Crud\Abstraction\InsertQueryBuilder
     */
    public function values(array $inputValues)
    {
       $valuesKeyword = "VALUES ";
       $isMultidimentional = is_array($inputValues[0]);

       if (!$isMultidimentional)
       {
          $valuesKeyword .= '('.self::getImplodedString($inputValues).')';
       }
       else
       {
          $tempValuesKeywords = [];
          foreach ($inputValues as $inputValue)
          {
              $tempValuesKeywords[] = '('.self::getImplodedString($inputValue).')';
          }

          $valuesKeyword .= self::getImplodedString($tempValuesKeywords);
          unset($tempValuesKeywords);
       }

       $this->queryBuilder = $this->queryBuilder->build($valuesKeyword);

       return $this;
    }

    /**
     * Implodes an array into a string
     *
     * @param array $arrayToImplode
     * @param string $delimiter Optional.
     * @access private
     * @return string
     */
    private function getImplodedString(array $arrayToImplode, string $delimiter = ",")
    {
        return implode($delimiter, $arrayToImplode);
    }
}
