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
use Requests;

/**
 * Class HTTPRequestFactory.
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since v0.0.1 08/06/2016 14:20
 */
class HTTPRequestFactory
{
	private static $headers;

	public static function bootstrap()
	{
		$configJson = file_get_contents(Constant::getGlobals()["config-dir"]["http-headers-config"]);

        self::$headers = json_decode($configJson, true);
	}

	public static function get($url, $extraHeaders = [])
	{
		self::bootstrap();

		return Requests::get($url, array_merge(self::$headers, $extraHeaders), ["timeout"=>12000]);
	}

	public static function post($url, $data, $extraHeaders = [])
	{
		self::bootstrap();

		return Requests::post($url, array_merge(self::$headers, $extraHeaders), $data, ["timeout"=>12000]);
	}
}