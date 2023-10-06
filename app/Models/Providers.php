<?php

namespace App\Models;

use CodeIgniter\Model;

class Providers extends Model
{
    protected $table = 'providers';

    protected $primaryKey = 'id';

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $allowedFields = [
        'name',
        'user_id',
        'provider_id',
    ];
}
