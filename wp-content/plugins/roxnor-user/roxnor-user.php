<?php

/**
 * Plugin Name: Roxnor User Management
 * Description: Roxnor User Management Plugin.
 * Plugin URI: https://github.com/shishir-xs
 * Author: Tareq Hasan
 * Author URI: https://github.com/shishir-xs
 * Version: 1.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (! defined('ABSPATH')) {
    exit;
}

final class Roxnor_User_Management
{
    private static $instance = null;
    const VERSION = '1.0';


    private function __construct()
    {
        $this->define_constants();
    }

    public function define_constants(): void
    {
        if (! defined('ROXNOR_USER_VERSION')) {
            define('ROXNOR_USER_VERSION', self::VERSION);
        }
    }
    
    public static function init(): Roxnor_User_Management
    {
        if (! self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

function roxnor_user_management(): Roxnor_User_Management
{
    return Roxnor_User_Management::init();
}
roxnor_user_management();
