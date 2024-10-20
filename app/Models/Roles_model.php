<?php

namespace App\Models;
use CodeIgniter\Model;

class Roles_model extends Model
{
    protected $table = 'tbl_roles';
    protected $primaryKey = 'IndexKey';

    protected $allowedFields = ['roles', 'is_active','latest_usernumber','created_by', 'created_at', 'updated_by', 'updated_at']; // Adjust based on your columns

    public function getActiveRoles()
    {
        return $this->where('is_active', '1')->findAll();
    }
}
