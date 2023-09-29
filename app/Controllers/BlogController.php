<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Post;
use CodeIgniter\Controller;

class BlogController extends Controller
{
    protected $post;
    protected $category;

    public function __construct()
    {
        $this->post = new Post();
        $this->category = new Category();
    }

    public function index()
    {
        $posts = $this->post->getAll('desc', 2);
        $posts['postModel'] = $this->post;
        return view('client/index', $posts);
    }

    public function postDetail(string $slug)
    {
        $data['post'] = $this->post->getPostDetail($slug);
        $data['categorys'] = $this->post->getCategory($data['post']['id']);

        return view('client/partials/post/detail', $data);
    }

    public function blog()
    {
        $posts = $this->post->getAll();
        $datas = [];
        foreach ($posts['posts'] as $key => $post) {
            $datas[$key]['categorys'] = $this->post->getCategory($post->id);
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
