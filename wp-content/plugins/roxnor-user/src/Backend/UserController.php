<?php

namespace Roxnor\UserManagement\Backend;

use Roxnor\UserManagement\Services\UserService;
use Roxnor\UserManagement\Repositories\UserRepository;

class UserController
{
    private $user_service;

    public function __construct()
    {
        $this->user_service = new UserService(new UserRepository());
        add_action('admin_post_create_user', [$this, 'create_user']);
        add_action('admin_post_update_user', [$this, 'update_user']);
        add_action('admin_post_delete_user', [$this, 'delete_user']);
    }

    public function create_user()
    {
        if (!wp_verify_nonce($_POST['user_nonce'], 'create_user')) {
            wp_die('Security check failed');
        }

        $result = $this->user_service->createUser($_POST);
        if ($result !== false) {
            wp_redirect(admin_url('admin.php?page=roxnor-user&action=list&message=created'));
        } else {
            error_log('User creation failed for data: ' . print_r($_POST, true));
            wp_redirect(admin_url('admin.php?page=roxnor-user&action=create&error=1'));
        }
        exit;
    }

    public function update_user()
    {
        if (!wp_verify_nonce($_POST['user_nonce'], 'edit_user')) {
            wp_die('Security check failed');
        }

        $id = intval($_POST['user_id']);
        $result = $this->user_service->updateUser($id, $_POST);
        if ($result !== false) {
            wp_redirect(admin_url('admin.php?page=roxnor-user&action=list&message=updated'));
        } else {
            error_log('User update failed for ID: ' . $id . ' Data: ' . print_r($_POST, true));
            wp_redirect(admin_url('admin.php?page=roxnor-user&action=edit&id=' . $id . '&error=1'));
        }
        exit;
    }

    public function delete_user()
    {
        if (!wp_verify_nonce($_GET['nonce'], 'delete_user_' . $_GET['id'])) {
            wp_die('Security check failed');
        }

        $id = intval($_GET['id']);
        if ($this->user_service->deleteUser($id)) {
            wp_redirect(admin_url('admin.php?page=roxnor-user&action=list&message=deleted'));
        } else {
            wp_redirect(admin_url('admin.php?page=roxnor-user&action=list&error=1'));
        }
        exit;
    }
}