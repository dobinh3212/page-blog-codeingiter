<?php

namespace App\Models;

use CodeIgniter\Model;

class PostCategory extends Model
{
    protected $table = 'post_category';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'post_id',
        'category_id',
    ];
}
