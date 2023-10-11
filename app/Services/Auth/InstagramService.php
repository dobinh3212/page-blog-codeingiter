<?php

namespace App\Services\Auth;

use App\Models\Providers;
use App\Models\User;
use Exception;

class InstagramService
{
    private string $instagramClientID;
    private string $instagramClientSecret;
    private string $instagramRedirectUri;
    private $act_url = 'https://api.instagram.com/oauth/access_token';
    private $ud_url = 'https://graph.instagram.com/v12.0/me?fields=username';
    private $provider;
    private $user;

    public function __construct()
    {
        $this->provider = new Providers();
        $this->user = new User();
        $this->instagramClientID = env('INSTAGRAM_CLIENT_ID');
        $this->instagramClientSecret = env('INSTAGRAM_CLIENT_SECRET');
        $this->instagramRedirectUri = env('INSTAGRAM_REDIRECT_URL');
    }

    /**
     * Get url redirect login Instagram
     * 
     * @return string
     */
    public function getInstagramLoginUrl()
    {
        $authURL = "https://api.instagram.com/oauth/authorize/?client_id=" . $this->instagramClientID . "&redirect_uri=" . urlencode($this->instagramRedirectUri) . "&response_type=code&scope=user_profile";
        return $authURL;
    }

    /**
     * Authenticate login Instagram
     * 
     * @return string
     */
    public function authenticateInstagram(string $code)
    {
        $accessToken = $this->getAccessToken($code);
        $userProfileInfo = $this->getUserProfileInfo($accessToken);
        $user_id = $this->attemptLoginInstagram($userProfileInfo);

        return $user_id;
    }

    /**
     * get accessToken
     * 
     * @return string
     */
    public function getAccessToken($code)
    {
        $urlPost = 'client_id=' . $this->instagramClientID . '&client_secret=' . $this->instagramClientSecret . '&redirect_uri=' . $this->instagramRedirectUri . '&code=' . $code . '&grant_type=authorization_code';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->act_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $urlPost);
        $data = json_decode(curl_exec($ch), true);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($http_code != '200') {
            throw new Exception('Error : Failed to receive access token' . $http_code);
        }
        return $data['access_token'];
    }

    /**
     * get user profile info
     * 
     * @return string
     */
    public function getUserProfileInfo($access_token)
    {
        $url = $this->ud_url . '&access_token=' . $access_token;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $data = json_decode(curl_exec($ch), true);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $data;
    }

    /**
     * attemp Authenticate login Instagram
     * 
     * @return string
     */
    public function attemptLoginInstagram($userInfo): string
    {
        if ($userInfo) {
            $provider = $this->provider->where('provider_id', $userInfo['id'])->first();
            if (empty($provider)) {
                $data = [
                    'name' => $userInfo['username'] ?? '',
                    'email' => '',
                ];
                $user_id = $this->user->insert($data);
                $data = [
                    'name' => 'Instagram',
                    'provider_id' => $userInfo['id'] ?? '',
                    'user_id' => $user_id,
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
