<?php

namespace Roxnor\UserManagement\Controllers;

use Roxnor\UserManagement\Services\UserService;

class UserController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        add_action('admin_post_create_user', [$this, 'create']);
        add_action('admin_post_update_user', [$this, 'update']);
        add_action('admin_post_delete_user', [$this, 'delete']);
    }

    public function create()
    {
        if (!wp_verify_nonce($_POST['user_nonce'], 'create_user')) {
            wp_die('Security check failed');
        }

        $result = $this->userService->createUser($_POST);
        
        if ($result) {
            wp_redirect(admin_url('admin.php?page=roxnor-user&action=list&message=created'));
        } else {
            wp_redirect(admin_url('admin.php?page=roxnor-user&action=create&error=1'));
        }
        exit;
    }

    public function update()
    {
        if (!wp_verify_nonce($_POST['user_nonce'], 'edit_user')) {
            wp_die('Security check failed');
        }

        $id = intval($_POST['user_id']);
        $result = $this->userService->updateUser($id, $_POST);

        if ($result) {
            wp_redirect(admin_url('admin.php?page=roxnor-user&action=list&message=updated'));
        } else {
            wp_redirect(admin_url('admin.php?page=roxnor-user&action=edit&id=' . $id . '&error=1'));
        }
        exit;
    }

    public function delete()
    {
        if (!wp_verify_nonce($_GET['nonce'], 'delete_user_' . $_GET['id'])) {
            wp_die('Security check failed');
        }

        $id = intval($_GET['id']);
        $result = $this->userService->deleteUser($id);

        if ($result) {
            wp_redirect(admin_url('admin.php?page=roxnor-user&action=list&message=deleted'));
        } else {
            wp_redirect(admin_url('admin.php?page=roxnor-user&action=list&error=1'));
        }
        exit;
    }
}