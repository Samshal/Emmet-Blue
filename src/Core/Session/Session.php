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
    /**
     * 
     */
    public static function init()
    {
        SESSION_START();
    }
    
    /**
     * 
     */
    public static function save($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * 
     */
    public static function get($key)
    {
        return $_SESSION[$key] ?? '';
    }

    /**
     * 
     */
    public static function delete($key = null)
    {
        if (is_null($key))
        {
            session_destroy();
        }
        else
        {
            unset($_SESSION[$key]);
        }
    }
}
