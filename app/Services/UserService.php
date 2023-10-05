<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    protected User $user;

    public function __construct()
    {
        $this->user = new User;
    }

    public function findAll(int $type = null)
    {
        $builder = $this->user->builder();
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function find($id)
    {
        return $this->user->find($id);
    }

    public function delete($id)
    {
        return $this->user->delete($id);
    }

    public function createUser($request)
    {
        $data = [
            'name' => $request->getPost('name'),
            'email' => $request->getPost('email'),
            'password' => password_hash($request->getPost('password'), PASSWORD_DEFAULT),
        ];

        return $this->user->insert($data);
    }

    public function updateUser(string $id, $request)
    {
        $data = [
            'name' => $request->getPost('name'),
            'email' => $request->getPost('email'),
        ];

        return $this->user->update($id, $data);
    }

    public function login(string $email, string $password)
    {
        $user = $this->user->where('email', $email)->first();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        
        return false;
    }
}
