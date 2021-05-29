<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Core\Factory;

use EmmetBlue\Core\Constant;

/**
 * Class DatabaseConnectionFactory.
 * Instantiates a new instance of ConnectableInterface
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since v0.0.1 08/06/2016 14:20
 */
class ElasticSearchClientFactory
{
    private static $clientObject;

    public static function bootstrap()
    {
        $configJson = file_get_contents(Constant::getGlobals()["config-dir"]["elasticsearch-config"]);

        $config = json_decode($configJson, true);

        if (isset($config["elasticsearch-enabled"]) && $config["elasticsearch-enabled"] == false){
            throw new \Exception("Elasticsearch unavailable");
        }

        self::$clientObject = \Elasticsearch\ClientBuilder::create()->setHosts($config["hosts"])->build();
    }

    public static function getClient()
    {
        self::bootstrap();
        return self::$clientObject;
    }
}