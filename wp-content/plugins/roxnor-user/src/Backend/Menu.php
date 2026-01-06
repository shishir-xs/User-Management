<?php 

namespace Roxnor\UserManagement\Backend;class Menu {
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'add_menu' ] );
    }

    public function add_menu() {
        $parent_slug = 'roxnor-user';
        $capability = 'manage_options';

        add_menu_page(
            'User Management',
            'User Management',
            $capability,
            $parent_slug,
              [ $this, 'render' ]
        );

        add_submenu_page(
            $parent_slug,
            'Dashboard',
            'Dashboard',
            $capability,
            $parent_slug,
            [ $this, 'render' ]
        );

        add_submenu_page(
            $parent_slug,
            'List',
            'List',
            $capability,
            $parent_slug . '&action=list',
            [ $this, 'render' ]
        );

        add_submenu_page(
            $parent_slug,
            'Import & Export',
            'Import & Export',
            $capability,
            'roxnor-import-export',
            [ $this, 'render' ]
        );
    }

    public function render() {
        $render = new Render();
        $render->render();
    }
}