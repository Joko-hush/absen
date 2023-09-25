<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Wa_models extends CI_Model
{
    function _send($phone, $message)
    {

        $apikey = '3729';
        $phone = $phone;
        $message = $message;
        $url = 'http://172.165.115.244/api/post.php';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, array(
            'Apikey'    => $apikey,
            'Phone'     => $phone,
            'Message'   => $message,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    }
    function _send2($phone, $message)
    {
        $apikey = '5731';
        $phone = $phone;
        $message = $message;
        $url = 'http://172.165.115.244/api/post.php';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, array(
            'Apikey'    => $apikey,
            'Phone'     => $phone,
            'Message'   => $message,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    }
    public function waWithFile($phone, $message, $file)
    {
        $token = '3729';
        $phone = $phone;
        $message = urlencode($message);
        $url = "http://172.165.115.244/api/send.php?token=$token&no=6285924089431&text=$message&file=$file";
        return $url;
    }
}
