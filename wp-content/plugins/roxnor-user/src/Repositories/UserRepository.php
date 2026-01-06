<?php

namespace Roxnor\UserManagement\Repositories;

use Roxnor\UserManagement\Models\User;

class UserRepository
{
    private $table_name;

    public function __construct()
    {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'roxnor_users';
    }

    public function createTable()
    {
        global $wpdb;
        
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE $this->table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name tinytext NOT NULL,
            email varchar(100) NOT NULL,
            phone varchar(20),
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public function findAll()
    {
        global $wpdb;
        $results = $wpdb->get_results("SELECT * FROM $this->table_name ORDER BY id DESC", ARRAY_A);
        return array_map(fn($data) => new User($data), $results);
    }

    public function findById($id)
    {
        global $wpdb;
        $result = $wpdb->get_row($wpdb->prepare("SELECT * FROM $this->table_name WHERE id = %d", $id), ARRAY_A);
        return $result ? new User($result) : null;
    }

    public function create($data)
    {
        global $wpdb;
        $result = $wpdb->insert($this->table_name, $data);
        if ($result === false) {
            error_log('Database insert error: ' . $wpdb->last_error);
            error_log('Failed data: ' . print_r($data, true));
        }
        return $result !== false ? $wpdb->insert_id : false;
    }

    public function update($id, $data)
    {
        global $wpdb;
        $result = $wpdb->update($this->table_name, $data, ['id' => $id]);
        if ($result === false) {
            error_log('Database update error: ' . $wpdb->last_error);
            error_log('Failed update data: ' . print_r($data, true));
            error_log('Update ID: ' . $id);
        }
        return $result !== false;
    }

    public function delete($id)
    {
        global $wpdb;
        return $wpdb->delete($this->table_name, ['id' => $id]) !== false;
    }

    public function count()
    {
        global $wpdb;
        return (int) $wpdb->get_var("SELECT COUNT(*) FROM $this->table_name");
    }
}