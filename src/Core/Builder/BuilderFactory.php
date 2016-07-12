<?php declare (strict_types=1);
/**
 * @license MIT
 * @author Chukwuma Nwali <chukznwali@gmail.com>
 */
namespace EmmetBlue\Core\Builder;

/**
 * class BuilderFactory..
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 * @since 28/05/2016
 */
class BuilderFactory
{
    /**
     * @var string
     */
    protected $builder;

    /**
     * @param string $builder
     * @param string $builderType
     * @throws \Exception
     */
    public function __construct(string $builder, string $builderType)
    {
        $builder = __NAMESPACE__."\\$builder\\$builderType$builder";
        $builder = new $builder;

        if (!($builder instanceof BuildableInterface))
        {
            throw new \Exception();
        }

        $this->builder = $builder;
    }

    /**
     * Returns a new instance of the requested builder object
     *
     * @return EmmetBlue\Core\Database\Builder\BuildableInterface
     */
    public function getBuilder() : BuildableInterface
    {
        return $this->builder;
    }
}
