<?php

namespace App\Models;

use CodeIgniter\Model;

class Auth extends \CodeIgniter\Model
{
    protected $table = 'users';
    protected $primaryKey = 'IndexKey';
    protected $allowedFields = ['id_number','role_id','firstname', 'middlename', 'lastname','gender','date_of_birth','phone_number','email', 'branch_id','username',  'password', 'password1', 'password2','profile','is_active','last_login_date','date_started','last_update_date','created_at','updated_at','login_attempt_count','is_locked','created_by','updated_by'];
   
  

public function recordExists($data)
{
        return $this->where($data)->first() !== null;
}
}