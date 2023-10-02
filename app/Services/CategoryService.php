<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    protected Category $category;

    public function __construct()
    {
        $this->category = new Category;
    }

    public function findAll(int $type = null)
    {
        $builder = $this->category->builder();
        if ($type) {
            $builder->where('categories.type', $type);
        }
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function find($id)
    {
        return $this->category->find($id);
    }

    public function delete($id)
    {
        return $this->category->delete($id);
    }

    public function createCategory($request)
    {
        $data = [
            'name' => $request->getPost('name'),
            'type' => $request->getPost('type'),
            'parent_id' => $request->getPost('parent_id'),
        ];

        return $this->category->insert($data);
    }

    public function updateCategory(string $id, $request)
    {
        $data = [
            'name' => $request->getPost('name'),
            'type' => $request->getPost('type'),
            'parent_id' => $request->getPost('parent_id'),
        ];

        return $this->category->update($id, $data);
    }
}
