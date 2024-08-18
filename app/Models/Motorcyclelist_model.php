<?php

namespace App\Models;

use CodeIgniter\Model;

class Motorcyclelist_model extends Model
{
    protected $table = 'tbl_motorcyclelist';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'pet_name', 'model_code', 'model_name', 'model_type', 'category',
        'is_active', 'created_by', 'created_at', 'updated_by', 'updated_at'
    ];
    

    public function getDataWithModelType()
    {
        // Build the query
        $builder = $this->builder();
        $builder->select('tbl_motorcyclelist.*, tbl_motorcycle_category.model_type as modeltype');
        $builder->join('tbl_motorcycle_category', 'tbl_motorcyclelist.model_type = tbl_motorcycle_category.id', 'left');
        $query = $builder->get();

        return $query->getResultArray();
    }

 // Method to check if a record with the given data already exists

    public function recordExists($data)
    {
        return $this->where($data)->first() !== null;
    }

    public function update_recordExists($data, $id = null)
    {
        $builder = $this->db->table($this->table);
        $builder->where($data);
    
        if ($id !== null) {
            $builder->where('id !=', $id);
        }
    
        $result = $builder->get()->getRow();
        
        // Debug output
        log_message('debug', 'Checking record existence: ' . print_r($data, true));
        log_message('debug', 'Result: ' . print_r($result, true));
    
        return $result;
    }
    
}
