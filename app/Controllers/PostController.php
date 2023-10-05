<?php

namespace App\Controllers;

use App\Services\CategoryService;
use App\Services\PostService;
use CodeIgniter\Controller;

class PostController extends Controller
{
    protected $postService;
    protected $categoryService;

    public function __construct()
    {
        $this->postService = new PostService();
        $this->categoryService = new CategoryService();
    }


    public function index(): string
    {
        $posts['posts'] = $this->postService->getAll('desc', null, 1, $this->request->getGet('search'));

        return view('admin/post/index', $posts);
    }

    public function create(): string
    {
        $categorys['categorys'] = $this->categoryService->findAll();

        return view('admin/post/create', $categorys);
    }

    public function store(): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->postService->createPost($this->request);

        return redirect()->to(base_url('admin/post'))->with('success', 'Create post successful');
    }

    public function edit($id): string
    {
        $data = $this->postService->editPost($id);

        return view('admin/post/edit', $data);
    }

    public function show($id): string
    {
        $data['post'] = $this->postService->find($id);

        return view('admin/post/detail', $data);
    }

    public function update($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->postService->updatePost($id, $this->request);

        return redirect()->to(base_url('admin/post'));
    }

    public function delete($id)
    {
        $this->postService->delete($id);

        return redirect()->to(base_url('admin/post'));
    }
}
