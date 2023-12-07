<?php

namespace library;

class Whatsapp
{
    public $token = "qaR8+Z3Ykcp8ss_-bV_s";

    public function sendSingle($target,$countryCode='62',$message)
    {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $target."|Ticketing",
                'message' => $message,
                'countryCode' => $countryCode, //optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: '.$this->token //change TOKEN to your actual token
            ),
        )
        );
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}