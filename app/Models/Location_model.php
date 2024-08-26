<?php

namespace App\Models;

use CodeIgniter\Model;

class Location_model extends Model
{
    protected $table = 'tbl_location';
    protected $primaryKey = 'IndexKey';
    protected $allowedFields = [
        'area','region','cluster_province', 'is_active', 'created_by', 'created_at', 'updated_by', 'updated_at'
    ];


     // Optional: Add a method to fetch distinct active categories
     public function getDistinctActiveCategories()
     {
         return $this->builder()
                     ->distinct()
                     ->select('category')
                     ->where('is_active', 1)
                     ->get()
                     ->getResultArray();
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
            $builder->where('IndexKey !=', $id);
        }
    
        $result = $builder->get()->getRow();
        
        // Debug output
        log_message('debug', 'Checking record existence: ' . print_r($data, true));
        log_message('debug', 'Result: ' . print_r($result, true));
    
        return $result;
    }
    
}
