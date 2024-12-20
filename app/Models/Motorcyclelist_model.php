<?php

namespace App\Models;

use CodeIgniter\Model;

class Motorcyclelist_model extends Model
{
    protected $table = 'tbl_motorcyclelist';
    protected $primaryKey = 'IndexKey';
    protected $allowedFields = [
        'pet_name', 'model_code', 'model_name',  'category_id',
        'is_active', 'created_by', 'created_at', 'updated_by', 'updated_at'
    ];
    

    public function getDataWithModelType()
{
    // Build the query
    $builder = $this->builder();
    
    // Select the necessary columns
    $builder->select('tbl_motorcyclelist.IndexKey, tbl_motorcyclelist.is_active, tbl_motorcyclelist.pet_name, tbl_motorcyclelist.model_code, tbl_motorcyclelist.model_name, tbl_motorcyclelist.created_by, tbl_motorcyclelist.created_at, tbl_motorcyclelist.updated_by, tbl_motorcyclelist.updated_at, tbl_motorcycle_category.model_type, tbl_motorcycle_category.category');
    
    // Join with the motorcycle category table
    $builder->join('tbl_motorcycle_category', 'tbl_motorcyclelist.category_id = tbl_motorcycle_category.IndexKey', 'left');
    
    // Add condition to fetch only records where is_active = 1
    $builder->where('tbl_motorcyclelist.is_active', 1);
    
    // Execute the query
    $query = $builder->get();
    
    // Return the result as an array
    return $query->getResultArray();
}

 // Method to check if a record with the given data already exists

 public function recordExists($data)
 {
     // Add the condition for is_active = 1
     return $this->where($data)
                 ->where('is_active', 1)
                 ->first() !== null;
 }
 
//to join the motorcycle category 

    public function getMotorcycleById($id)
{
    return $this->select('tbl_motorcyclelist.model_name,tbl_motorcyclelist.IndexKey, tbl_motorcyclelist.pet_name, tbl_motorcyclelist.model_code, tbl_motorcycle_category.model_type, tbl_motorcycle_category.category')
                ->join('tbl_motorcycle_category', 'tbl_motorcyclelist.category_id = tbl_motorcycle_category.IndexKey', 'left')
                ->where('tbl_motorcyclelist.IndexKey', $id)
                ->get()
                ->getRowArray();
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
