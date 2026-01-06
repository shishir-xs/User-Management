<?php 

namespace Roxnor\UserManagement\Backend;

class Menu {
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'add_menu' ] );
    }

    public function add_menu() {
        add_users_page(
            'User Management',
            'User Management',
            'manage_options',
            'user-management',
            [ $this, 'render_page' ]
        );
    }

    public function render_page() {
        echo '<h1>Hello This is RoxNor User Management Page !</h1>';
    }
}