<?php

namespace Roxnor\UserManagement\Services;

use Roxnor\UserManagement\Repositories\UserRepository;
use Roxnor\UserManagement\Models\User;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->findAll();
    }

    public function getUserById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function createUser($data)
    {
        $sanitizedData = [
            'name' => sanitize_text_field($data['user_name']),
            'email' => sanitize_email($data['user_email']),
            'phone' => sanitize_text_field($data['user_phone'])
        ];

        if (empty($sanitizedData['name']) || empty($sanitizedData['email'])) {
            error_log('UserService: Empty name or email');
            return false;
        }

        $result = $this->userRepository->create($sanitizedData);
        if (!$result) {
            error_log('UserService: Repository create failed');
        }
        return $result;
    }

    public function updateUser($id, $data)
    {
        $sanitizedData = [
            'name' => sanitize_text_field($data['user_name']),
            'email' => sanitize_email($data['user_email']),
            'phone' => sanitize_text_field($data['user_phone'])
        ];

        if (empty($sanitizedData['name']) || empty($sanitizedData['email'])) {
            error_log('UserService: Empty name or email in update');
            return false;
        }

        $result = $this->userRepository->update($id, $sanitizedData);
        if (!$result) {
            error_log('UserService: Repository update failed for ID: ' . $id);
        }
        return $result;
    }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }

    public function getUserCount()
    {
        return $this->userRepository->count();
    }

    public function searchUsers($search)
    {
        $users = $this->getAllUsers();
        
        if (empty($search)) {
            return $users;
        }

        return array_filter($users, function($user) use ($search) {
            return stripos($user->name, $search) !== false || 
                   stripos($user->email, $search) !== false || 
                   stripos($user->phone, $search) !== false;
        });
    }
}