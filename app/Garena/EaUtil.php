<?php

namespace App\Garena;

use Exception;

class EaUtil
{

    public static function post($api_url, $data)
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $api_url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            $curl_errno = curl_errno($ch);
            $curl_error = curl_error($ch);
            curl_close($ch);

            if ($curl_errno > 0) {
                return [
                    'errors' => "cURL Error ($curl_errno): $curl_error"
                ];
            }

            $result = json_decode($output,true);

            if (is_null($result) || (isset($result['result']) && $result['result'] == false)) {
                return [
                    'errors' => 'Empty response data'
                ];
            }

            return $result;

        } catch (Exception $e) {
            return [
                'errors' => $e->getMessage()
            ];
        }
    }

    public static function get($api_url)
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $api_url);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $output = curl_exec($ch);
            $curl_errno = curl_errno($ch);
            $curl_error = curl_error($ch);
            curl_close($ch);

            if ($curl_errno > 0) {
                return [
                    'errors' => "cURL Error ($curl_errno): $curl_error"
                ];
            }

            $result = json_decode($output,true);

            if (is_null($result) || (isset($result['result']) && $result['result'] == false)) {
                return [
                    'errors' => 'Empty response data'
                ];
            }

            return $result;

        } catch (Exception $e) {
            return [
                'errors' => $e->getMessage()
            ];
        }
    }

    public static function sendGiftToUser($coach_id, $item, $title)
    {
        if ($coach_id == "" || $item == 0) {
            return false;
        }

        $api_url = env('GIFT_SERVER') . "/optool/coach/" . $coach_id . "/bagitem";



        $data = [
            'operatorname' => env('GIFT_OPERATOR_NAME'),
            'items' => [
                'itemid' => intval($item),
                'count' => 1
            ],
            'title' => $title,
            'msg' => $title
        ];

        return self::post($api_url, $data);

    }

    public static function removeGiftFromUser($coach_id, $item)
    {
        if ($coach_id == "" || $item == 0) {
            return false;
        }

        $data = [
            'operatorname' => env('GIFT_OPERATOR_NAME'),
            'items' => [
                'itemid' => intval($item),
                'count' => 1
            ],
            'title' => "GAS",
            'msg' => "Remove following Fo3 request"
        ];

        $api_url = env('GIFT_SERVER') . "/optool/coach/" . $coach_id . "/bagitem/".$item;

        return self::post($api_url, $data);

    }

    public static function getCoaches($uid) {
        $api_url = env('GIFT_SERVER') . "/optool/account/name/is/" . $uid . "@grn";
        return self::get($api_url);
    }

    public static function getAccount($uid)
    {
        $api_url = env('GIFT_SERVER') . "/optool/account/".$uid."@grn/info";
        return self::get($api_url);
    }


}