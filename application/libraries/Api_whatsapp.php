<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
// require_once('PHPExcel.php');

class Api_whatsapp{
    function wa_notif($msgg,$phonee)
    {
        $sender = 'ljnbabelan';
        $phone = $phonee;
        $msg = $msgg;
        // if ($sender == "mahfud") {
                // $token = "rasJFCC37ewayax21uu2Caog9CCqyT3KSwBWFqQAbQMdMAefxa";
                // $phone = $phone; //untuk group pakai groupid contoh: 62812xxxxxx-xxxxx
                $message = $msg;
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'http://103.171.85.211:8000/send-message',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => 'sender='.$sender.'&number='.$phone.'&message='.$message,
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                return $response;
                // redirect('permohonan/index/'.$this->hash_url->base64_url_encode($otp).'/'.$this->hash_url->base64_url_encode($phone));
        // }
    }
    function wa_notif_doc($msgg,$phonee,$file)
    {
        $sender = 'ljnbabelan';
        $phone = $phonee;
        $msg = $msgg;
        // if ($sender == "mahfud") {
                // $token = "rasJFCC37ewayax21uu2Caog9CCqyT3KSwBWFqQAbQMdMAefxa";
                // $phone = $phone; //untuk group pakai groupid contoh: 62812xxxxxx-xxxxx
                $message = $msg;
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'http://103.171.85.211:8000/send-media',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => 'sender='.$sender.'&number='.$phone.'&caption='.$message.'&file='.$file,
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                return $response;
                // redirect('permohonan/index/'.$this->hash_url->base64_url_encode($otp).'/'.$this->hash_url->base64_url_encode($phone));
        // }
    }
}