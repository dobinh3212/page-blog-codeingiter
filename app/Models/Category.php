<?php

namespace App\Models;

use CodeIgniter\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'type',
        'parent_id',
    ];

    public function parent($id)
    {
        return $this->find($id);
    }

    public function createCategory($request)
    {
        $data = [
            'name' => $request->getPost('name'),
            'type' => $request->getPost('type'),
            'parent_id' => $request->getPost('parent_id'),
        ];

        return $this->insert($data);
    }

    public function updateCategory(string $id, $request)
    {
        $data = [
            'name' => $request->getPost('name'),
            'type' => $request->getPost('type'),
            'parent_id' => $request->getPost('parent_id'),
        ];
        
        return $this->update($id, $data);
    }
}
