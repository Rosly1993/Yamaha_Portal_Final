<?php

namespace App\Models;

use CodeIgniter\Model;

class Activitylogs_model extends Model
{
    protected $table = 'tbl_log_details';
    protected $primaryKey = 'IndexKey';
    protected $allowedFields = [
        'username','activity','details', 'date_record'
    ];


     
    
}
