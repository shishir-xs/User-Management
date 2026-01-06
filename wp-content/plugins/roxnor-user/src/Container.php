<?php

namespace Roxnor\UserManagement;

use Roxnor\UserManagement\Repositories\UserRepository;
use Roxnor\UserManagement\Services\UserService;
use Roxnor\UserManagement\Controllers\UserController;
use Roxnor\UserManagement\Controllers\ViewController;

class Container
{
    private static $instance = null;
    private $services = [];

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getUserRepository()
    {
        if (!isset($this->services['userRepository'])) {
            $this->services['userRepository'] = new UserRepository();
        }
        return $this->services['userRepository'];
    }

    public function getUserService()
    {
        if (!isset($this->services['userService'])) {
            $this->services['userService'] = new UserService($this->getUserRepository());
        }
        return $this->services['userService'];
    }

    public function getUserController()
    {
        if (!isset($this->services['userController'])) {
            $this->services['userController'] = new UserController($this->getUserService());
        }
        return $this->services['userController'];
    }

    public function getViewController()
    {
        if (!isset($this->services['viewController'])) {
            $this->services['viewController'] = new ViewController($this->getUserService());
        }
        return $this->services['viewController'];
    }
}