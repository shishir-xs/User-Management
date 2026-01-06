<?php

namespace Roxnor\UserManagement\Backend;

use Roxnor\UserManagement\Container;

class Render
{
    private $viewController;

    public function __construct()
    {
        $container = Container::getInstance();
        $this->viewController = $container->getViewController();
    }

    public function render()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : '';

        switch ($action) {
            case 'list':
                $this->viewController->list();
                break;
            case 'create':
                $this->viewController->create();
                break;
            case 'edit':
                $this->viewController->edit();
                break;
            case 'show':
                $this->viewController->show();
                break;
            case 'import-export':
                include ROXNOR_USER_PATH . '/src/Backend/Views/import-export.php';
                break;
            default:
                $this->viewController->dashboard();
                break;
        }
    }
}