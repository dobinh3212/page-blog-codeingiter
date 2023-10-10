<?php

namespace App\Services\Auth;

use App\Models\Providers;
use App\Models\User;

class FacebookService
{
    private string $facebookID;
    private string $facebookSecret;
    private string $facebookRedirectUri;
    private $provider;
    private $user;

    public function __construct()
    {
        $this->provider = new Providers();
        $this->user = new User();
        $this->facebookID = env('FACEBOOK_CLIENT_ID');
        $this->facebookSecret = env('FACEBOOK_CLIENT_SECRET');
        $this->facebookRedirectUri = env('FACEBOOK_REDIRECT_URL');
    }

    /**
     * Get url redirect login Facebook
     * 
     * @return string
     */
    public function getFacebookLoginUrl()
    {
        $app_id = $this->facebookID;
        $redirect_uri = $this->facebookRedirectUri;
        $permissions = ['public_profile', 'email'];
        return "https://www.facebook.com/dialog/oauth?client_id={$app_id}&redirect_uri={$redirect_uri}&scope=" . implode(',', $permissions);
    }

    /**
     * Authenticate login Facebook
     * 
     * @return string
     */
    public function authenticateFacebook($code): string
    {
        $app_id = $this->facebookID;
        $app_secret = $this->facebookSecret;

        $redirect_uri = $this->facebookRedirectUri;

        $token_url = "https://graph.facebook.com/v12.0/oauth/access_token?client_id={$app_id}&redirect_uri={$redirect_uri}&client_secret={$app_secret}&code={$code}";
        $token_data = json_decode(file_get_contents($token_url), true);

        if (isset($token_data['access_token'])) {
            $graph_url = "https://graph.facebook.com/v12.0/me?fields=id,first_name,last_name,email&access_token={$token_data['access_token']}";
            $userInfo = json_decode(file_get_contents($graph_url), true);
            return $this->attemptLoginFacebook($userInfo);
        }
        return null;
    }
    
    /**
     * attemp Authenticate login Facebook
     * 
     * @return string
     */
    public function attemptLoginFacebook($userInfo): string
    {
        if ($userInfo) {
            $provider = $this->provider->where('provider_id', $userInfo['id'] ?? '')->first();
            if (empty($provider)) {
                $user = $this->user->where('email', $userInfo['email'])->first();
                if (empty($user)) {
                    $data = [
                        'name' => $userInfo['last_name'] . ' ' . $userInfo['first_name'] ?? '',
                        'email' => $userInfo['email'] ?? '',
                    ];
                    $user_id = $this->user->insert($data);
                }
                $data = [
                    'name' => 'Facebook',
                    'provider_id' => $userInfo['id'] ?? '',
                    'user_id' => $user['id'] ?? $user_id,
                ];
                $this->provider->insert($data);
                $user_id =  $data['user_id'];
            } else {
                $user = $this->user->find($provider['user_id']);
                $user_id = $user['id'];
            }

            return $user_id;
        }
    }
}
