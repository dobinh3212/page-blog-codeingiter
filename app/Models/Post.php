<?php

namespace App\Models;

use CodeIgniter\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'title',
        'description',
        'img',
        'content',
        'author_id',
        'slugs',
    ];

    public function categorys()
    {
        return $this->belongsToMany('CategoryModel', 'post_category', 'post_id', 'category_id');
    }

    public function users()
    {
        return $this->hasMany('UserModel', 'author_id', 'id');
    }

    public function createSlug($str)
    {
        $str = strtolower($str);
        $str = trim($str);
        $str = preg_replace('/[^a-z0-9-]+/', '-', $str);
        $str = preg_replace('/-+/', '-', $str);

        return $str;
    }

    public function createPost($request)
    {
        $data = [
            'title' => $request->getVar('title'),
            'slugs' => $this->createSlug($request->getVar('title')),
            'description' => $request->getVar('description'),
            'content' => $request->getVar('content'),
            'category_id' => implode(',', $request->getVar('category_id')),
        ];
        // if ($imgFile = $this->request->getFile('img')) {
        // $newFileName = $imgFile->getRandomName();
        // $imgFile->move(ROOTPATH . 'public/uploads', $newFileName);
        // $data['img'] = 'uploads/' . $newFileName;
        // }
        return $this->insert($data);
    }

    public function updatePost(string $id, $request)
    {
        $data = [
            'name' => $request->getPost('title'),
            'slugs' => $this->createSlug($request->getVar('title')),
            'description' => $request->getVar('description'),
            'content' => $request->getVar('content'),
            'category_id' => implode(',', $request->getVar('category_id')),
        ];
        
        return $this->update($id, $data);
    }
}
