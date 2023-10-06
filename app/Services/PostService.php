<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
use Cocur\Slugify\Slugify;

class PostService
{
    protected Post $post;
    protected PostCategory $postCategory;
    protected Category $category;
    protected CategoryService $categoryService;

    public function __construct()
    {
        $this->post = new Post();
        $this->postCategory = new PostCategory();
        $this->category = new Category();
        $this->categoryService = new CategoryService();
    }

    public function find($id)
    {
        return $this->post->find($id);
    }

    public function delete($id)
    {
        return $this->post->delete($id);
    }

    public function getCategory(string $post_id, int $type = null)
    {
        $builder = $this->post->db->table('post_category');
        $builder->select('categories.*');
        $builder->join('categories', 'categories.id = post_category.category_id');
        $builder->where('post_id', $post_id);
        if ($type) {
            $builder->where('categories.type', $type);
        }
        $query = $builder->get();

        return $query->getResult();
    }

    public function getAll(string $order = 'desc', int $perPage = null, int $page = 1, string $search = null)
    {
        $builder = $this->post->builder();
        if ($perPage) {
            $offset = ($page - 1) * $perPage;
            $builder->limit($perPage, $offset);
        }
        if ($search) {
            $builder->like('title', '%' . $search . '%');
        }
        $builder->orderBy('id', $order);
        return $builder->get()->getResult();
    }

    public function getPost($request): mixed
    {
        if (!empty($request['category']) || !empty($request['tag'])) {
            $query = $this->category;
            if (!empty($request['category'])) {
                $query->where('name', $request['category']);
                $query->where('type', 1);
            } elseif (!empty($request['tag'])) {
                $query->where('name', $request['tag']);
                $query->where('type', 2);
            }
            if ($category = $query->first()) {
                $categoryId = $category['id'];
                $this->postCategory->select('post_id');
                $this->postCategory->where('category_id', $categoryId);
                $postCategoryQuery = $this->postCategory->get();
                $postIds = $postCategoryQuery->getResultArray();
                if ($postIds) {
                    $postIds = array_column($postIds, 'post_id');
                    $this->post->select('*');
                    $this->post->whereIn('id', $postIds);
                    return $this->post->get()->getResult();
                }
            }
        }
        return $this->post->get()->getResult();
    }


    public function createSlug($str)
    {
        $slugify = new Slugify();
        $slug = $slugify->slugify($str);

        return $slug . time();
    }

    public function createPost($request)
    {
        $data = [
            'title' => $request->getVar('title'),
            'slugs' => $this->createSlug($request->getVar('title')),
            'description' => $request->getVar('description'),
            'content' => $request->getVar('content'),
        ];
        $imgFile = $request->getFile('img');
        if ($imgFile->isValid()) {
            $newFileName = $imgFile->getRandomName();
            $imgFile->move(ROOTPATH . 'public/uploads', $newFileName);
            $data['img'] = 'uploads/' . $newFileName;
        }
        $post_id = $this->post->insert($data);
        if ($request->getVar('tag_name') ?? '') {
            $categoryIds = $this->createTag($request->getVar('tag_name'));
        }
        $categoryIds = array_merge($categoryIds ?? [], $request->getVar('category_id') ?? []);
        $this->updatePivotPostCategory($post_id ?? '', $categoryIds);

        return true;
    }

    public function editPost(string $id)
    {
        $data['post'] = $this->find($id);
        $data['category'] = $this->getCategory($id, 1);
        $data['categorys'] = $this->categoryService->findAll();
        $tagNames = [];
        foreach ($this->getCategory($id, 2) as $tagResult) {
            $tagNames[] = $tagResult->name;
        }
        $data['tagNames'] = $tagNames;

        $categoryIds = [];
        foreach ($data['category'] as $categoryResult) {
            $categoryIds[] = $categoryResult->id;
        }
        $data['categoryIds'] = $categoryIds;

        return $data;
    }

    public function updatePost(string $id, $request)
    {
        $data = [
            'title' => $request->getVar('title'),
            'slugs' => $this->createSlug($request->getVar('title')),
            'description' => $request->getVar('description'),
            'content' => $request->getVar('content'),
        ];
        $imgFile = $request->getFile('img');
        if ($imgFile->isValid()) {
            $newFileName = $imgFile->getRandomName();
            $imgFile->move(ROOTPATH . 'public/uploads', $newFileName);
            $data['img'] = 'uploads/' . $newFileName;
        }
        $this->post->update($id, $data);
        $categoryIds = [];
        if ($request->getVar('tag_name') ?? '') {
            $categoryIds = $this->createTag($request->getVar('tag_name'));
        }
        $categoryIds = array_merge($categoryIds ?? [], $request->getVar('category_id') ?? []);
        $this->updatePivotPostCategory($id, $categoryIds);

        return true;
    }

    public function createTag($tagName): mixed
    {
        $tagNames = explode(',', $tagName);
        $tagCategoryIds = [];
        foreach ($tagNames as $tagName) {
            $category  = new Category();
            $existingTag = $category->where('name', $tagName)->where('type', 2)->first();
            if ($existingTag) {
                $tagCategoryIds[] = $existingTag['id'];
            } else {
                $data['name'] = $tagName;
                $data['type'] = 2;
                $tagCategory = $category->insert($data);
                $tagCategoryIds[] = $tagCategory ?? '';
            }
        }

        return $tagCategoryIds;
    }

    public function updatePivotPostCategory($post_id, $categoryIds)
    {
        $postCategory  = new PostCategory();
        $postCategory->where('post_id', $post_id)->delete();
        foreach ($categoryIds as $category) {
            $data['post_id'] = $post_id;
            $data['category_id'] = $category;
            $postCategory->insert($data);
        }

        return true;
    }

    public function getPostDetail(string $slug)
    {
        return $this->post->where('slugs', $slug)->first();
    }
}
