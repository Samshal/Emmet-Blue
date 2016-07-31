<?php declare(strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Core\Session;

/**
 * Class Session
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since v0.0.1 08/06/2016 14:20
 */
class Session
{
    protected $session;
    
    /**
     * 
     */
    public static function init($session = "")
    {
        $this->session = $session;
    }
    
    /**
     * 
     */
    public static function save($key, $value)
    {
        $session[$key] = $value;
    }

    /**
     * 
     */
    public static function get($key)
    {
        return $session[$key] ?? '';
    }

    /**
     * 
     */
    public static function delete($key)
    {
       unset($session[$key]);
    }
}
