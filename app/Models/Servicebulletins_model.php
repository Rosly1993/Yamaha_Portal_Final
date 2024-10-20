<?php

namespace App\Models;

use CodeIgniter\Model;

class Servicebulletins_model extends Model
{
    protected $table = 'tbl_service_bulletins';
    protected $primaryKey = 'IndexKey';
    protected $allowedFields = [
        'title','reference_number','is_confidential','date_published','attachment','is_active', 'created_by', 'created_at', 'updated_by', 'updated_at'
    ];



    public function recordExists($title, $reference_number)
    {
        // Example query to check if record exists
        return $this->where('title', $title)
                    ->where('reference_number', $reference_number)
                    ->where('is_active', 1)
                    ->first() !== null;
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
    public function countCurrentMonthYear()
    {
        return $this->where('YEAR(created_at)', date('Y'))
                    ->where('MONTH(created_at)', date('m'))
                    ->where('is_active', 1)
                    ->countAllResults();
    }
    
}
