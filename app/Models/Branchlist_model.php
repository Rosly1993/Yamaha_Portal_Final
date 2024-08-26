<?php

namespace App\Models;

use CodeIgniter\Model;

class Branchlist_model extends Model
{
    protected $table = 'tbl_3sbranch_list';
    protected $primaryKey = 'IndexKey';
    protected $allowedFields = [
        'head_office', 'dealer_code', 'dealer_name',  'location_id','shop_type','date_opened',
        'is_active', 'created_by', 'created_at', 'updated_by', 'updated_at'
    ];
    

    public function getDataWithLocation()
    {
        // Build the query
        $builder = $this->builder();
        $builder->select('tbl_3sbranch_list.IndexKey,tbl_3sbranch_list.updated_by,tbl_3sbranch_list.updated_at,tbl_3sbranch_list.date_opened, tbl_3sbranch_list.head_office, tbl_3sbranch_list.dealer_code, tbl_3sbranch_list.dealer_name, tbl_3sbranch_list.shop_type, tbl_3sbranch_list.is_active, tbl_3sbranch_list.created_by, tbl_3sbranch_list.created_at, tbl_3sbranch_list.updated_at, tbl_location.area, tbl_location.region, tbl_location.cluster_province');
        $builder->join('tbl_location', 'tbl_3sbranch_list.location_id = tbl_location.IndexKey', 'left');
        $query = $builder->get();
    
        return $query->getResultArray();
    }
    
 // Method to check if a record with the given data already exists

    public function recordExists($data)
    {
        return $this->where($data)->first() !== null;
    }

//to join the motorcycle category 

    public function getBranchlistById($id)
{
    return $this->select('tbl_3sbranch_list.IndexKey,tbl_3sbranch_list.head_office,tbl_3sbranch_list.dealer_code,tbl_3sbranch_list.dealer_name,
tbl_3sbranch_list.created_at,tbl_3sbranch_list.is_active,tbl_3sbranch_list.created_by,tbl_3sbranch_list.updated_at,tbl_3sbranch_list.updated_by,tbl_location.area,tbl_location.region,tbl_location.cluster_province')
                ->join('tbl_location', 'tbl_3sbranch_list.location_id = tbl_location.IndexKey', 'left')
                ->where('tbl_3sbranch_list.IndexKey', $id)
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
