<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'IndexKey';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    // protected $allowedFields    = ['firstname', 'middlename', 'lastname', 'email', 'password','last_login_date','login_attempt_count','is_locked'];
    protected $allowedFields = ['id_number','role_id','firstname', 'middlename', 'lastname','gender','date_of_birth','phone_number','email', 'branch_id','username',  'password', 'password1', 'password2','profile','is_active','last_login_date','date_started','last_update_date','created_at','updated_at','login_attempt_count','is_locked','created_by','updated_by','password_status','temp_password','activation_key','otp'];
   
  
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}

