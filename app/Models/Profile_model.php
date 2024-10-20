<?php

namespace App\Models;

use CodeIgniter\Model;

class Profile_model extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'IndexKey';
    // protected $allowedFields = [
    //     'area','region','cluster_province', 'is_active', 'created_by', 'created_at', 'updated_by', 'updated_at'
    // ];
    protected $allowedFields = ['id_number','role_id','firstname', 'middlename', 'lastname','gender','date_of_birth','phone_number','email', 'branch_id','username',  'password', 'password1', 'password2','profile','is_active','last_login_date','date_started','last_update_date','created_at','updated_at','login_attempt_count','is_locked','created_by','updated_by'];


   

    
}
