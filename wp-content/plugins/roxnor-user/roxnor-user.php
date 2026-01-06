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

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

final class Roxnor_User_Management {
   const VERSION = '1.0';


   private function __construct() {
      $this->define_constants();
   }

   public function define_constants() {
       if ( ! defined( 'ROXNOR_USER_VERSION' ) ) {
           define( 'ROXNOR_USER_VERSION', self::VERSION );
       }
   }
}