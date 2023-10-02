<?php

namespace App\Models;

use CodeIgniter\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'id';
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $allowedFields = [
        'name',
        'type',
        'parent_id',
    ];

    public function parent($id)
    {
        return $this->find($id);
    }
}
