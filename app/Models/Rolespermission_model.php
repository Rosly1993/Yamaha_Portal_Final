<?php
namespace App\Models;

use CodeIgniter\Model;

class Rolespermission_model extends Model
{
    protected $table = 'tbl_roles_permission';
    protected $primaryKey = 'IndexKey';
    protected $allowedFields = [
        'role_id', 'page_name', 'is_view', 'is_add', 'is_edit', 'is_delete', 'is_active', 'created_by', 'created_at', 'updated_by', 'updated_at'
    ];

    public function getJoinedData()
    {
        return $this->select('tbl_roles_permission.role_id, tbl_roles_permission.IndexKey, tbl_roles.roles, tbl_roles_permission.is_active, tbl_roles_permission.created_by, tbl_roles_permission.created_at, tbl_roles_permission.updated_by, tbl_roles_permission.updated_at')
                    ->join('tbl_roles', 'tbl_roles_permission.role_id = tbl_roles.IndexKey', 'LEFT')
                    ->groupBy('tbl_roles.roles')
                    ->findAll();
    }

    public function getDistinctActiveCategories()
    {
        return $this->builder()
                    ->distinct()
                    ->select('category')
                    ->where('is_active', 1)
                    ->get()
                    ->getResultArray();
    }

    public function getRoleByName($role_name)
    {
        return $this->where('role_id', $role_name)->first();
    }

    public function getRolePermissions($role_id)
    {
        return $this->select('tbl_roles_permission.role_id, tbl_roles_permission.IndexKey, tbl_roles.roles, tbl_roles_permission.page_name, tbl_roles_permission.is_view, tbl_roles_permission.is_add, tbl_roles_permission.is_edit, tbl_roles_permission.is_delete')
                    ->join('tbl_roles', 'tbl_roles_permission.role_id = tbl_roles.IndexKey')
                    ->where('tbl_roles_permission.role_id', $role_id)
                    ->findAll();
    }

    public function update_roles_permission($page_name, $role_id, $is_view, $is_add, $is_edit, $is_delete)
    {
        $builder = $this->builder(); // Get the Builder instance

        $builder->where('role_id', $role_id);
        $builder->where('page_name', $page_name);
        $builder->update([
            'is_view' => $is_view,
            'is_add' => $is_add,
            'is_edit' => $is_edit,
            'is_delete' => $is_delete
        ]);
    }

    public function recordExists($data)
    {
        return $this->where($data)->first() !== null;
    }

    public function update_recordExists($data, $id = null)
    {
        $builder = $this->builder(); // Use the Builder instance
        $builder->where($data);
    
        if ($id !== null) {
            $builder->where('IndexKey !=', $id);
        }
    
        $result = $builder->get()->getRow();
        
        // Debug output
        log_message('debug', 'Checking record existence: ' . print_r($data, true));
        log_message('debug', 'Result: ' . print_r($result, true));
    
        return $result;
    }
}
