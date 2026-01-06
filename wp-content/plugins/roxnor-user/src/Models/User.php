<?php

namespace Roxnor\UserManagement\Models;

class User
{
    public $id;
    public $name;
    public $email;
    public $phone;
    public $created_at;

    public function __construct($data = [])
    {
        if ($data) {
            $this->id = $data['id'] ?? null;
            $this->name = $data['name'] ?? '';
            $this->email = $data['email'] ?? '';
            $this->phone = $data['phone'] ?? '';
            $this->created_at = $data['created_at'] ?? null;
        }
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'created_at' => $this->created_at
        ];
    }
}