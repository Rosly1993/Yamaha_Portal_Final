<?php

namespace App\Models;

use CodeIgniter\Model;

class Servicemanuals_model extends Model
{
    protected $table = 'tbl_service_manuals';
    protected $primaryKey = 'IndexKey';
    protected $allowedFields = [
        'motorcycle_id','is_confidential','year_published','attachment','is_active', 'created_by', 'created_at', 'updated_by', 'updated_at'
    ];


   
    public function getDataWithModel()
    {
        // Initialize the builder for tbl_service_manuals
        $builder = $this->db->table('tbl_service_manuals');
        
        // Select the desired columns from both tables
        $builder->select('
            tbl_service_manuals.IndexKey,
            tbl_service_manuals.year_published,
            tbl_service_manuals.attachment,
            tbl_service_manuals.created_by,
            tbl_service_manuals.is_confidential,
            tbl_service_manuals.is_active,
            tbl_service_manuals.created_at,
            tbl_service_manuals.updated_at,
            tbl_service_manuals.updated_by,
            tbl_motorcyclelist.model_name,
            tbl_motorcyclelist.model_code
        ');
    
        // Perform the INNER JOIN with tbl_motorcyclelist
        $builder->join('tbl_motorcyclelist', 'tbl_service_manuals.motorcycle_id = tbl_motorcyclelist.IndexKey', 'inner');
    
        // Add the WHERE condition to filter by is_active = '1'
        $builder->where('tbl_service_manuals.is_active', '1');
    
        // Execute the query and get the result
        $query = $builder->get();
    
        // Return the result as an array
        return $query->getResultArray();
    }
//to join the motorcycle lis
    public function getModelById($id)
    {
        return $this->select('tbl_service_manuals.IndexKey,tbl_service_manuals.year_published,tbl_motorcyclelist.model_name,tbl_motorcyclelist.model_code')
                    ->join('tbl_motorcyclelist', 'tbl_service_manuals.motorcycle_id = tbl_motorcyclelist.IndexKey', 'left')
                    ->where('tbl_service_manuals.IndexKey', $id)
                    ->get()
                    ->getRowArray();
    }


   

    public function recordExists($motorcycle_id, $year_published, $id = null)
    {
        $builder = $this->builder();

        $builder->where('motorcycle_id', $motorcycle_id);
        $builder->where('year_published', $year_published);

        if ($id !== null) {
            $builder->where('IndexKey !=', $id); // Exclude the record being updated
        }

        $query = $builder->get();
        return $query->getRow();
    }

    public function update_recordExists($userData, $id)
    {
        return $this->recordExists($userData['motorcycle_id'], $userData['year_published'], $id);
    }

    public function countCurrentMonthYear()
    {
        return $this->where('YEAR(created_at)', date('Y'))
                    ->where('MONTH(created_at)', date('m'))
                    ->countAllResults();
    }
}
    

