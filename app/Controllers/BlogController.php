<?php

namespace App\Controllers;

use App\Services\CategoryService;
use App\Services\PostService;
use CodeIgniter\Controller;

class BlogController extends Controller
{
    protected $postService;
    protected $categoryService;

    public function __construct()
    {
        $this->postService = new PostService();
        $this->categoryService = new CategoryService();
    }

    public function index()
    {
        $posts = $this->postService->getAll('desc', 2);
        $posts['postModel'] = $this->postService;
        return view('client/index', $posts);
    }

    public function postDetail(string $slug)
    {
        $data['post'] = $this->postService->getPostDetail($slug);
        $data['categorys'] = $this->postService->getCategory($data['post']['id']);

        return view('client/partials/post/detail', $data);
    }

    public function blog()
    {
        $posts = $this->postService->getAll();
        $datas = [];
        foreach ($posts['posts'] as $key => $post) {
            $datas[$key]['categorys'] = $this->postService->getCategory($post->id);
            $datas[$key]['post'] = $post;
        }

        return view('client/partials/post/blog', ['datas' => $datas]);
    }

    public function work()
    {
        return view('client/partials/work/work');
    }

    public function workDetail($id)
    {
        return view('client/partials/work/workDetail');
    }
}
