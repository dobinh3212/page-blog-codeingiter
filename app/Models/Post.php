<?php

namespace App\Models;

use CodeIgniter\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $allowedFields = [
        'title',
        'description',
        'img',
        'content',
        'author_id',
        'slugs',
    ];
}
