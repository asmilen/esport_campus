<?php

namespace App\Garena;

use Exception;

class OAuth
{
    public static function authUrl()
    {
        return env('AUTH_SERVER') . '/oauth/login' . '?response_type=token&client_id=' . env('AUTH_CLIENT_ID') . '&redirect_uri=' . url('oauth/callback') . '&all_platforms=1';
    }
    
    public static function logoutUrl($access_token)
    {
        return env('AUTH_SERVER') . '/oauth/logout' . '?access_token=' . $access_token. '&redirect_uri=' . url('/');
    }


    public static function handleAccessToken($access_token)
    {
        $get_user_info_url = env('AUTH_SERVER') .  '/oauth/user/info/get' . '?access_token=' . $access_token;
        try {
            $page = file_get_contents($get_user_info_url);
            $content = json_decode($page);

            if (isset($content->error)) {
                return  [
                    'errors' =>  $content->error
                ];
            } else {
                return [
                    'access_token' => $access_token,
                    'uid' => isset($content->uid) ? $content->uid : -1,
                    'nickname' => isset($content->nickname) ? $content->nickname : '',
                    'open_id' => isset($content->open_id) ? $content->open_id : -1,
                    'username' => isset($content->username) ? $content->username : '',
                    'platform' => isset($content->platform) ? $content->platform : '-1'
                ];
            }
        } catch (Exception $e) {
            return  [
                'errors' => $e->getMessage()
            ];
        }
    }
}