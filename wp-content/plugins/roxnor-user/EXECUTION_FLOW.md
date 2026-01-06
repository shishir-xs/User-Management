# User Management Plugin - Execution Flow

## 🚀 Initialization Flow
```
roxnor-user.php
├── Roxnor_User_Management::init()
├── define_constants()
├── register_activation_hook() → pluginActivate()
└── add_action('plugins_loaded') → init_plugin()
    └── Backend::__construct()
        ├── Backend\Menu::__construct()
        ├── Backend\Assets::__construct()
        └── Container::getInstance()
            └── getUserController() → UserController::__construct()
```

## 📋 Load Flow (Page Request)
```
WordPress Admin Request
├── Menu::add_menu() → add_menu_page()
├── Menu::render() → Render::__construct()
│   └── Container::getInstance()
│       └── getViewController() → ViewController::__construct()
└── Render::render()
    └── ViewController::{action}()
        ├── UserService::{method}()
        ├── UserRepository::{method}()
        └── render('view', $data)
```

## ⚙️ Configuration Flow
```
Plugin Activation
├── register_activation_hook()
├── Backend::createTables()
├── Container::getInstance()
├── getUserRepository()
├── UserRepository::createTable()
└── dbDelta() → Database Table Created
```

## ➕ Create Flow
```
Create Form Submit
├── admin-post.php?action=create_user
├── UserController::create()
├── wp_verify_nonce()
├── UserService::createUser()
│   ├── sanitize_text_field()
│   ├── sanitize_email()
│   └── UserRepository::create()
│       └── $wpdb->insert()
├── wp_redirect() → list page
└── ViewController::list()
    ├── getMessage() → Success Notice
    └── render('list', $data)
```

## ✏️ Update Flow
```
Edit Form Submit
├── admin-post.php?action=update_user
├── UserController::update()
├── wp_verify_nonce()
├── UserService::updateUser()
│   ├── sanitize_text_field()
│   ├── sanitize_email()
│   └── UserRepository::update()
│       └── $wpdb->update()
├── wp_redirect() → list page
└── ViewController::list()
    ├── getMessage() → Success Notice
    └── render('list', $data)
```

## 🗑️ Delete Flow
```
Delete Link Click
├── admin-post.php?action=delete_user
├── UserController::delete()
├── wp_verify_nonce()
├── UserService::deleteUser()
│   └── UserRepository::delete()
│       └── $wpdb->delete()
├── wp_redirect() → list page
└── ViewController::list()
    ├── getMessage() → Success Notice
    └── render('list', $data)
```

## 👁️ View Flow
```
View Request (?action=show&id=1)
├── Menu::render()
├── Render::render()
├── ViewController::show()
├── UserService::getUserById()
├── UserRepository::findById()
│   └── $wpdb->get_row()
├── new User($data)
└── render('show', ['user' => $user])
    └── Views/show.php
```

## 📊 List Flow
```
List Request (?action=list)
├── Menu::render()
├── Render::render()
├── ViewController::list()
├── UserService::getAllUsers()
├── UserRepository::findAll()
│   └── $wpdb->get_results()
├── array_map() → User objects
├── getMessage() → Notices
└── render('list', $data)
    └── Views/list.php
```

## 🏗️ SOLID Architecture Layers

### Controller Layer
```
UserController (Form Actions)
├── create() → Handle form submissions
├── update() → Handle form updates
└── delete() → Handle deletions

ViewController (View Data)
├── dashboard() → Prepare dashboard data
├── list() → Prepare list data
├── create() → Prepare create form
├── edit() → Prepare edit form
└── show() → Prepare show data
```

### Service Layer
```
UserService (Business Logic)
├── createUser() → Validate & sanitize
├── updateUser() → Validate & sanitize
├── deleteUser() → Business rules
├── getUserById() → Single user
├── getAllUsers() → All users
├── getUserCount() → Statistics
└── searchUsers() → Filter logic
```

### Repository Layer
```
UserRepository (Data Access)
├── create() → $wpdb->insert()
├── update() → $wpdb->update()
├── delete() → $wpdb->delete()
├── findById() → $wpdb->get_row()
├── findAll() → $wpdb->get_results()
├── count() → $wpdb->get_var()
└── createTable() → dbDelta()
```

### Model Layer
```
User (Data Structure)
├── Properties: id, name, email, phone, created_at
├── __construct() → Initialize from array
└── toArray() → Convert to array
```

## 🔄 Dependency Injection Flow
```
Container::getInstance()
├── getUserRepository() → Singleton UserRepository
├── getUserService() → UserService(UserRepository)
├── getUserController() → UserController(UserService)
└── getViewController() → ViewController(UserService)
```