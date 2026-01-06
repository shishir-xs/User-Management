<?php

namespace Roxnor\UserManagement\Backend;

class Assets
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
    }

    public function enqueue_admin_assets($hook)
    {
        // Only load on our plugin pages
        if (strpos($hook, 'roxnor-user') === false && strpos($hook, 'roxnor-import-export') === false) {
            return;
        }

        // Enqueue CSS only
        wp_enqueue_style(
            'roxnor-user-admin',
            ROXNOR_USER_URL . '/assets/css/admin.css',
            [],
            ROXNOR_USER_VERSION
        );
    }
}