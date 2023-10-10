<?php

namespace App\Controllers;

use App\Models\Providers;
use App\Models\User;
use App\Services\Auth\FacebookService;
use App\Services\Auth\GoogleService;
use App\Services\UserService;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;

class AuthController extends Controller
{
    protected $userService;
    protected $session;
    protected $googleService;
    protected $provider;
    protected $user;
    protected $facebookService;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->googleService = new GoogleService();
        $this->facebookService = new FacebookService();
        $this->session = \Config\Services::session();
        $this->provider = new Providers();
        $this->user = new User();
    }

    /**
     * @return string
     */
    public function login(): string
    {
        return view('auth/login');
    }

    /**
     * Login user
     * 
     * @return RedirectResponse
     */
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

    /**
     * Logout user
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        $this->session->remove('user_id');
        $this->session->remove('username');

        return redirect()->to(route_to('viewLogin'));
    }

    /**
     * Login with Google
     * 
     * @return RedirectResponse
     */
    public function googleLogin(): RedirectResponse
    {
        $authUrl = $this->googleService->getGoogleLoginUrl();
        header("Location: $authUrl");
        exit();
    }

    /**
     * Callback login with Google
     * 
     * @return RedirectResponse
     */
    public function googleLoginCallback()
    {
        $code = $this->request->getGet('code');
        if ($code) {
            $user_id = $this->googleService->authenticateGoogle($code);
            if ($user_id) {
                $this->session->set('user_id', $user_id);
                return redirect()->to(route_to('dashboard'));
            }
        }
        $this->session->setFlashdata('error', 'Authentication failed');
        return view('auth/login');
    }

    /**
     * Login with Facebook
     * 
     * @return RedirectResponse
     */
    public function facebookLogin(): RedirectResponse
    {
        $authUrl = $this->facebookService->getFacebookLoginUrl();
        header("Location: $authUrl");
        exit();
    }

    /**
     * Callback login with Facebook
     * 
     * @return RedirectResponse
     */
    public function facebookLoginCallback()
    {
        $code = $this->request->getGet('code');
        if ($code) {
            $user_id = $this->facebookService->authenticateFacebook($code);
            if ($user_id) {
                $this->session->set('user_id', $user_id);
                return redirect()->to(route_to('dashboard'));
            }
        }

        $this->session->setFlashdata('error', 'Authentication failed');
        return view('auth/login');
    }
}
