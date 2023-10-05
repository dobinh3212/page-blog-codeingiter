<?php

namespace App\Controllers;

use App\Services\UserService;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    protected $userService;
    protected $session;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->session = \Config\Services::session();
    }

    public function login()
    {
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userService->login($email, $password);

        if ($user) {
            $this->session->set('user_id', $user['id']);
            $this->session->set('username', $user['name']);

            return redirect()->to(route_to('dashboard'));
        } else {
            $this->session->setFlashdata('error', 'Account password is incorrect');
            return view('auth/login');
        }
    }

    public function logout()
    {
        $this->session->remove('user_id');
        $this->session->remove('username');

        return redirect()->to(route_to('viewLogin'));
    }
}
