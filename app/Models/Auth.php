<?php

namespace App\Models;

use CodeIgniter\Model;

class Auth extends \CodeIgniter\Model
{
    protected $table = 'users';
    protected $primaryKey = 'IndexKey';
    protected $allowedFields = ['firstname', 'middlename', 'lastname', 'username', 'email', 'password', 'is_active'];
}

