<?php

namespace App\Services\Auth;

use App\Models\Providers;
use App\Models\User;

class GoogleService
{
    private string $googleClientID;
    private string $googleClientSecret;
    private string $redirectUri;
    private $provider;
    private $user;

    public function __construct()
    {
        $this->provider = new Providers();
        $this->user = new User();
        $this->googleClientID = env('GOOGLE_CLIENT_ID');
        $this->googleClientSecret = env('GOOGLE_CLIENT_SECRET');
        $this->redirectUri = env('GOOGLE_REDIRECT_URL');
    }

    /**
     * Get url redirect login Google
     * 
     * @return string
     */
    public function getGoogleLoginUrl(): string
    {
        return 'https://accounts.google.com/o/oauth2/auth?' . http_build_query([
            'client_id' => $this->googleClientID,
            'redirect_uri' => $this->redirectUri,
            'response_type' => 'code',
            'scope' => 'openid email profile',
        ]);
    }

    /**
     * Authenticate login Google
     * 
     * @return string
     */
    public function authenticateGoogle(string $code)
    {
        $tokenUrl = 'https://accounts.google.com/o/oauth2/token';
        $tokenData = [
            'code' => $code,
            'client_id' => $this->googleClientID,
            'client_secret' => $this->googleClientSecret,
            'redirect_uri' => $this->redirectUri,
            'grant_type' => 'authorization_code',
        ];

        $tokenResponse = $this->sendPostRequest($tokenUrl, $tokenData);
        $tokenInfo = json_decode($tokenResponse);
        if (isset($tokenInfo->access_token)) {
            $userInfoUrl = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $tokenInfo->access_token;
            $userInfoResponse = $this->sendGetRequest($userInfoUrl);
            $userInfo = json_decode($userInfoResponse);
            return $this->attemptLoginGoogle($userInfo);
        }
        return null;
    }

    /**
     * attemp Authenticate login Google
     * 
     * @return string
     */
    public function attemptLoginGoogle($userInfo): string
    {
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
            return $user_id;
        }
    }

    /**
     * Send Post Request Google
     * 
     * @param $url
     * @param $data
     * @return string
     */
    private function sendPostRequest($url, $data): string
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    /**
     * Send Get Request Google
     * 
     * @param $url
     * @return string
     */
    private function sendGetRequest($url): string
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
