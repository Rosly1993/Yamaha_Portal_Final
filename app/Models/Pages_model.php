<?php

namespace App\Models;
use CodeIgniter\Model;

class Pages_model extends Model
{
    protected $table = 'tbl_pages';
    protected $primaryKey = 'IndexKey';

    protected $allowedFields = ['page_name']; // Adjust based on your columns

    public function getActivePages()
    {
        return $this->where('is_active', '1')->findAll();
    }
}
