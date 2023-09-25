<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mail_models extends CI_Model
{
    public function send($to, $from, $subject, $body)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://172.165.115.224/sendmail.php");


        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            "to=$to&from=$from&subject=$subject&text=$body"
        );
        $output = curl_exec($ch);

        curl_close($ch);
        return ($output);
    }
}
