<?php

namespace EndorphineBednyy;

use BitrixMainConfigOption;

class DadataApi
{
    private $token;

    public function __construct()
    {
        // Получаем токен из настроек модуля
        $this->token = Option::get("endorphine.bednyy", "dadata_token", "");
    }

    public function parseAddress($address)
    {
        if (empty($this->token)) {
            return null;
        }

        $url = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address";
        $data = ["query" => $address];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Token {$this->token}"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);
        if (isset($result['suggestions'][0]['data'])) {
            return [
                "COUNTRY" => $result['suggestions'][0]['data']['country'],
                "REGION" => $result['suggestions'][0]['data']['region_with_type'],
                "CITY" => $result['suggestions'][0]['data']['city_with_type'],
                "STREET" => $result['suggestions'][0]['data']['street_with_type'],
                "HOUSE" => $result['suggestions'][0]['data']['house'],
                "FLAT" => $result['suggestions'][0]['data']['flat'],
                "ZIP" => $result['suggestions'][0]['data']['postal_code'],
            ];
        }

        return null;
    }
}
