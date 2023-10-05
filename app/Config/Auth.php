<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Auth extends BaseConfig
{

    public $model = 'App\Models\UserModel';
    public $tableUsers = 'users';
    public $fieldEmail = 'email';
    public $fieldPassword = 'password';
}
