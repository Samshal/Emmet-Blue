<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Core\Factory;

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
		$configJson = file_get_contents("bin/configs/elasticsearch-config.json");

        $config = json_decode($configJson);

        self::$clientObject = \Elasticsearch::clientBuilder()->fromConfig($config);
	}

	public static function getClient()
	{
		self::bootstrap();
		return self::$clientObject;
	}
}