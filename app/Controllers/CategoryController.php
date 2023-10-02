<?php

namespace App\Controllers;

use App\Services\CategoryService;
use CodeIgniter\Controller;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService;
    }

    public function index(): string
    {
        $categorys['categorys'] = $this->categoryService->findAll();

        return view('admin/category/index', $categorys);
    }

    public function create(): string
    {
        $categorys['categorys'] = $this->categoryService->findAll(1);

        return view('admin/category/create', $categorys);
    }

    public function store(): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->categoryService->createCategory($this->request);

        return redirect()->to(base_url('admin/category'));
    }

    public function edit($id): string
    {
        $category['category'] = $this->categoryService->find($id);
        $category['categorys'] = $this->categoryService->findAll();

        return view('admin/category/edit', $category);
    }

    public function show($id): string
    {
        $category['category'] = $this->categoryService->find($id);

        return view('admin/category/detail', $category);
    }

    public function update($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->categoryService->updateCategory($id, $this->request);

        return redirect()->to(base_url('admin/category'));
    }

    public function delete($id)
    {
        $this->categoryService->delete($id);

        return redirect()->to(base_url('admin/category'));
    }
}
