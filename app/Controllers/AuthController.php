<?php

namespace App\Controllers;

use App\Models\Providers;
use App\Models\User;
use App\Services\GoogleService;
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

    public function __construct()
    {
        $this->userService = new UserService();
        $this->googleService = new GoogleService();
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
            $userInfo = $this->googleService->authenticateGoogle($code);
            if ($userInfo) {
                $provider = $this->provider->where('provider_id', $userInfo->id)->first();
                if (empty($provider)) {
                    $user = $this->user->where('email', $userInfo->email)->first();
                    if (empty($user)) {
                        $data = [
                            'name' => $userInfo->name ?? '',
                            'email' => $userInfo->email ?? '',
                        ];
                        $user_id = $this->user->insert($data);
                    }
                    $data = [
                        'name' => 'Google',
                        'provider_id' => $userInfo->id ?? '',
                        'user_id' => $user['id'] ?? $user_id,
                    ];
                    $this->provider->insert($data);
                    $user_id =  $data['user_id'];
                } else {
                    $user = $this->user->find($provider['user_id']);
                    $user_id = $user['id'];
                }
                $this->session->set('user_id', $user_id);

                return redirect()->to(route_to('dashboard'));
            }
        }

        $this->session->setFlashdata('error', 'Authentication failed');
        return view('auth/login');
    }
}
