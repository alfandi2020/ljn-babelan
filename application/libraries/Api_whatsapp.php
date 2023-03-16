<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
// require_once('PHPExcel.php');

class Api_whatsapp{
    function wa_notif($msgg,$phonee)
    {
    $sender = 'mahfud';
    $phone = $phonee;
    $msg = $msgg;
        // if ($sender == "mahfud") {
                // $token = "rasJFCC37ewayax21uu2Caog9CCqyT3KSwBWFqQAbQMdMAefxa";
                // $phone = $phone; //untuk group pakai groupid contoh: 62812xxxxxx-xxxxx
                $message = $msg;
                $curl = curl_init();
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://ljn.fantecno.net/cron/send',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => 'key='.$sender.'&phone='.$phone.'&msg='.$msgg,
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                return $response;
                // redirect('permohonan/index/'.$this->hash_url->base64_url_encode($otp).'/'.$this->hash_url->base64_url_encode($phone));
        // }
    }
}