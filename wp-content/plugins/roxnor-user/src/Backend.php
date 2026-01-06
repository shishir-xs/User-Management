<?php 

namespace Roxnor\UserManagement;

use Roxnor\UserManagement\Backend\Assets;

class Backend {
    private $container;
    
    public function __construct() {
        $this->container = Container::getInstance();
        
        new Backend\Menu();
        new Assets();
        
        register_activation_hook(ROXNOR_USER_FILE, [$this, 'createTables']);
    }
    
    public function createTables() {
        $this->container->getUserRepository()->createTable();
    }
}