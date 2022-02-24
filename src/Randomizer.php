<?php

class Randomizer
{
    const URL = "https://api.random.org/json-rpc/4/invoke";
    const API_KEY = "69aa35db-90e1-4702-923f-1a285aa1778e";
    const HEADERS = ['Content-Type:application/json'];
    protected array $options = [
        'method' => null,
        'n' => 1,
        'min' => 1,
        'max' => 100,
        'replacement' => true,
        'base' => 10
    ];

    private function request(string $method, int $n, int $min, int $max, bool $replacement, int $base)
    {
        $post_data = [
            "jsonrpc" => "2.0",
            "method" => $method,
            "params" => [
                "apiKey" => self::API_KEY,
                "n" => $n,
                "min" => $min,
                "max" => $max,
                "replacement" => $replacement,
                "base" => $base
            ],
            "id" => random_int(0, 99999)
        ];
        $data_json = json_encode($post_data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, self::HEADERS);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $r = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($r);
        if(count($result->result->random->data) == 1)
        {
            return $result->result->random->data[0];
        }
        else
        {
            return $result->result->random->data;
        }
    }

    public function generateIntegers(int $n = 1, int $min = 0, int $max = 100, bool $replacement = true, int $base = 10)
    {
        $method = "generateIntegers";
        $result = $this->request($method, $n, $min, $max, $replacement, $base);
        return $result;
    }

}