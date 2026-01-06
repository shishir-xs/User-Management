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
        register_activation_hook( __FILE__, [ $this, 'pluginActivate' ] );
    }

    public function define_constants(): void
    {
        if (! defined('ROXNOR_USER_VERSION')) {
            define('ROXNOR_USER_VERSION', self::VERSION);
        }
        if (! defined('ROXNOR_USER_FILE')) {
            define('ROXNOR_USER_FILE', __FILE__);
        }
        if (! defined('ROXNOR_USER_PATH')) {
            define('ROXNOR_USER_PATH', __DIR__);
        }
        if (! defined('ROXNOR_USER_URL')) {
            define('ROXNOR_USER_URL', plugins_url('', ROXNOR_USER_FILE));
        }
        if (! defined('ROXNOR_USER_ASSETS')) {
            define('ROXNOR_USER_ASSETS', ROXNOR_USER_URL . '/assets');
        }
    }

    public static function init(): Roxnor_User_Management
    {
        if (! self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function pluginActivate(): void {
        $installed = get_option( 'roxnor_user_installed' );

        if ( ! $installed ) {
            update_option( 'roxnor_user_installed', time() );
        }

        update_option( 'roxnor_user_version', ROXNOR_USER_VERSION );
    }
}

function roxnor_user_management(): Roxnor_User_Management
{
    return Roxnor_User_Management::init();
}
roxnor_user_management();
