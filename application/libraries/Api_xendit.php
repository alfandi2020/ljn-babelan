<?php


Class Api_xendit {
    function create_va($data)
    {
        $key = 'xnd_production_IciBYQPfQ819WW5bP7x31pOSZVl6Nn6P1NiVwabystIa9TOv9B7lQvw2tWA';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.xendit.co/callback_virtual_accounts',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . base64_encode($key . ':') . '',
                'Content-Type: application/json',
                // 'Cookie: __cf_bm=cHC2xVccIxL8cL1cDlqVP16atW_qPlh7oQuOElHkqDE-1722085281-1.0.1.1-T07myao_itTHsol2SqsVtYJ0vriNSW502woefXvLoDgSEs9an1.fQLrjSOQOL2F7UzGwzY4rHKP9wOoaDpTn2w'
            ),
        )
        );

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
        
    }
}