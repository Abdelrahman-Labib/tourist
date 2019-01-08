<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    public static function send($tokens,$ar_text,$en_text,$type,$post_id=null)
    {
        $fields = array
        (
            "registration_ids" => $tokens,
            "priority" => 10,
            'data' => [
                'type' => $type,
                'ar_text' => $ar_text,
                'en_text' => $en_text,
                'post_id' => $post_id,
            ],
            'notification' => [
                'type' => $type,
                'ar_text' => $ar_text,
                'en_text' => $en_text,
                'post_id' => $post_id,
            ],
            'vibrate' => 1,
            'sound' => 1
        );
        $headers = array
        (
            'accept: application/json',
            'Content-Type: application/json',
            'Authorization: key=' .
            'AAAAgq4cdoE:APA91bH5a5MmkmDYFGTm27k3Z7ni5R-2bCwUb73JM04wiBsjOhFaXQegg-vYE8QvhVtH4X8fv95u7nEbhhOdaMVcJcUThFKP5QfCrW_au0Opz19TeqGbna0ejsHyab_h6sLGC-TkkIgu'

        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        //  var_dump($result);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);

        return $result;
    }
}
