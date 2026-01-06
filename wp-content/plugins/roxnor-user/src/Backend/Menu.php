<?php 

namespace Roxnor\UserManagement\Backend;

class Menu {
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'add_menu' ] );
    }

    public function add_menu() {
        $parent_slug = 'roxnor-user-management';
        $capability = 'manage_options';

        add_menu_page(
            'User Management',
            'User Management',
            $capability,
            $parent_slug,
            [ $this, 'render_page' ]
        );

        add_submenu_page(
            $parent_slug,
            'Dashboard',
            'Dashboard',
            $capability,
            $parent_slug,
            [ $this, 'render_page' ]
        );

        add_submenu_page(
            $parent_slug,
            'Import & Export',
            'Import & Export',
            $capability,
            'roxnor-import-export',
            [ $this, 'render_import_export' ]
        );
    }

    public function render_page() {
        echo '<h1>Hello This is RoxNor User Management Page !</h1>';
    }

    public function render_import_export() {
        echo '<h1>Hello This is RoxNor Import & Export Page !</h1>';
    }
}