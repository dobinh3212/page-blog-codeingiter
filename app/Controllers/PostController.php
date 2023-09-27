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
        $posts['posts'] = $this->post->findAll();

        return view('admin/post/index', $posts);
    }

    public function create(): string
    {
        $categorys['categorys'] = $this->category->findAll();

        return view('admin/post/create', $categorys);
    }

    public function store(): \CodeIgniter\HTTP\RedirectResponse
    {
        // helper('form');
        // $validationRules = [
        //     'title' => 'required|min_length[5]|max_length[255]',
        //     'description' => 'required|min_length[10]|max_length[500]',
        //     'content' => 'required',
        //     'category_id' => 'required',
        //     // 'img' => 'uploaded[img]|max_size[img,1024]|is_image[img]'
        // ];

        // if (!$this->validate($validationRules)) {
        //     return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        // }
        $this->post->createPost($this->request);

        return redirect()->to(base_url('admin/post'))->with('success', 'Create post successful');
    }

    public function edit($id): string
    {
        $data['post'] = $this->post->find($id);
        $data['category'] = $this->category->find($id);
        $data['categorys'] = $this->category->findAll();
        $data['tagNames'] = [];
        $data['categoryIds'] = [];

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
