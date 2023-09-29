<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Post;
use CodeIgniter\Controller;

class PostController extends Controller
{
    protected $post;
    protected $category;

    public function __construct()
    {
        $this->post = new Post();
        $this->category = new Category();
    }


    public function index(): string
    {
        $posts = $this->post->getAll();

        return view('admin/post/index', $posts);
    }

    public function create(): string
    {
        $categorys['categorys'] = $this->category->findAll();

        return view('admin/post/create', $categorys);
    }

    public function store(): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->post->createPost($this->request);

        return redirect()->to(base_url('admin/post'))->with('success', 'Create post successful');
    }

    public function edit($id): string
    {
        $data['post'] = $this->post->find($id);
        $data['category'] = $this->post->getCategory($id, 1);
        $data['categorys'] = $this->category->findAll();
        $tagNames = [];
        foreach ($this->post->getCategory($id, 2) as $tagResult) {
            $tagNames[] = $tagResult->name;
        }
        $data['tagNames'] = $tagNames;

        $categoryIds = [];
        foreach ($data['category'] as $categoryResult) {
            $categoryIds[] = $categoryResult->id;
        }
        $data['categoryIds'] = $categoryIds;

        return view('admin/post/edit', $data);
    }

    public function show($id): string
    {
        $data['post'] = $this->post->find($id);

        return view('admin/post/detail', $data);
    }

    public function update($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->post->updatePost($id, $this->request);

        return redirect()->to(base_url('admin/post'));
    }

    public function delete($id)
    {
        $this->post->delete($id);

        return redirect()->to(base_url('admin/post'));
    }
}
