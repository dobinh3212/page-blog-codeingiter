<?php

namespace App\Controllers;

use App\Models\Category;
use CodeIgniter\Controller;

class CategoryController extends Controller
{
    protected $category;

    public function __construct()
    {
        $this->category = new Category();
    }

    public function index(): string
    {
        $categorys['categorys'] = $this->category->findAll();

        return view('admin/category/index', $categorys);
    }

    public function create(): string
    {
        $categorys['categorys'] = $this->category->findAll();

        return view('admin/category/create', $categorys);
    }

    public function store(): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->category->createCategory($this->request);

        return redirect()->to(base_url('admin/category'));
    }

    public function edit($id): string
    {
        $category['category'] = $this->category->find($id);
        $category['categorys'] = $this->category->findAll();

        return view('admin/category/edit', $category);
    }

    public function show($id): string
    {
        $category['category'] = $this->category->find($id);

        return view('admin/category/detail', $category);
    }

    public function update($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->category->updateCategory($id, $this->request);

        return redirect()->to(base_url('admin/category'));
    }

    public function delete($id)
    {
        $this->category->delete($id);

        return redirect()->to(base_url('admin/category'));
    }
}
