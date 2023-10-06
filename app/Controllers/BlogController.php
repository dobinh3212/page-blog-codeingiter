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
        $data['posts'] = $this->postService->getAll('desc', 2);
        $data['postModel'] = $this->postService;
        return view('client/index', $data);
    }

    public function postDetail(string $slug)
    {
        $data['post'] = $this->postService->getPostDetail($slug);
        if (empty($data['post'])) {
            return view('errors/html/error_404', ['message' => 'Page not found']);
        }
        $data['categorys'] = $this->postService->getCategory($data['post']['id']);
        $data['posts'] = $this->postService->getAll('desc', 6);

        return view('client/partials/post/detail', $data);
    }

    public function blog()
    {
        $posts = $this->postService->getPost($this->request->getGet());
        $datas = [];
        foreach ($posts as $key => $post) {
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
