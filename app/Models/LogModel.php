<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'tbl_log_details';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'activity', 'details', 'date_record'];
}