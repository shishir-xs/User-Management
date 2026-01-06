<?php

namespace Roxnor\UserManagement\Controllers;

use Roxnor\UserManagement\Services\UserService;

class ViewController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function dashboard()
    {
        $data = [
            'total_users' => $this->userService->getUserCount(),
            'recent_users' => array_slice($this->userService->getAllUsers(), 0, 5)
        ];
        
        return $this->render('dashboard', $data);
    }

    public function list()
    {
        $search = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
        $users = $search ? $this->userService->searchUsers($search) : $this->userService->getAllUsers();
        
        $data = [
            'users' => $users,
            'search' => $search,
            'message' => $this->getMessage()
        ];
        
        return $this->render('list', $data);
    }

    public function create()
    {
        $data = [
            'error' => isset($_GET['error']) ? '<div class="notice notice-error is-dismissible">
                <p>Error creating user. Please try again.</p>
            </div>' : ''
        ];
        
        return $this->render('create', $data);
    }

    public function edit()
    {
        $user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $user = $this->userService->getUserById($user_id);
        
        if (!$user) {
            wp_die('User not found.');
        }
        
        $data = [
            'user' => $user,
            'error' => isset($_GET['error']) ? '<div class="notice notice-error is-dismissible">
                <p>Error updating user. Please try again.</p>
            </div>' : ''
        ];
        
        return $this->render('edit', $data);
    }

    public function show()
    {
        $user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $user = $this->userService->getUserById($user_id);
        
        if (!$user) {
            wp_die('User not found.');
        }
        
        $data = ['user' => $user];
        
        return $this->render('show', $data);
    }

    private function render($view, $data = [])
    {
        extract($data);
        include ROXNOR_USER_PATH . "/src/Backend/Views/{$view}.php";
    }

    private function getMessage()
    {
        if (!isset($_GET['message'])) return '';
        
        switch ($_GET['message']) {
            case 'created':
                return '<div class="notice notice-success is-dismissible">
                    <p>User created successfully!</p>
                </div>';
            case 'updated':
                return '<div class="notice notice-success is-dismissible">
                    <p>User updated successfully!</p>
                </div>';
            case 'deleted':
                return '<div class="notice notice-success is-dismissible">
                    <p>User deleted successfully!</p>
                </div>';
            default:
                return '';
        }
    }
}