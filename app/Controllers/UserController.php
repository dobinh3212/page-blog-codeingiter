<?php

namespace App\Controllers;

use App\Services\UserService;
use CodeIgniter\Controller;

class UserController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService;
    }

    public function index(): string
    {
        $data['users'] = $this->userService->findAll();

        return view('admin/user/index', $data);
    }

    public function create(): string
    {
        return view('admin/user/create');
    }

    public function store(): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->userService->createUser($this->request);

        return redirect()->to(base_url('admin/user'));
    }

    public function edit($id): string
    {
        $data['user'] = $this->userService->find($id);

        return view('admin/user/edit', $data);
    }

    public function show($id): string
    {
        $data['user'] = $this->userService->find($id);

        return view('admin/user/detail', $data);
    }

    public function update($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->userService->updateUser($id, $this->request);

        return redirect()->to(base_url('admin/user'));
    }

    public function delete($id)
    {
        $this->userService->delete($id);

        return redirect()->to(base_url('admin/category'));
    }
}
