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

    private function request(array $post_data)
    {
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

    /**
     * @param int $n - Кол-во генерируемых чисел, [1, 1e4]
     * @param int $min - Нижний порог [-1e9, 1e9]
     * @param int $max - Верхний порог [-1e9, 1e9]
     * @param bool $replacement - Повторения [true, false]
     * @param int $base - num base [2, 8, 10, 16]
     * @return mixed
     * @throws Exception
     */
    public function generateIntegers(int $n = 1, int $min = 0, int $max = 100, bool $replacement = true, int $base = 10)
    {
        $method = "generateIntegers";
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
        return $this->request($post_data);
    }

    /**
     * @param int $n - Кол-во генерируемых UUIDs, [1, 1000]
     * @return mixed
     * @throws Exception
     */
    public function generateUUIDs(int $n = 1)
    {
        $method = 'generateUUIDs';
        $post_data = [
            "jsonrpc" => "2.0",
            "method" => $method,
            "params" => [
                "apiKey" => self::API_KEY,
                "n" => $n
            ],
            "id" => random_int(0, 99999)
        ];
        $result = $this->request($post_data);
        return $result;
    }

    /**
     * @param int $n - Кол-во генерируемых Blobs [1, 100]
     * @param int $size - Размер BLOB [1, 1048576]
     * @return mixed
     * @throws Exception
     */
    public function generateBlobs(int $n = 1, int $size = 1024)
    {
        $method = 'generateBlobs';
        $post_data = [
            "jsonrpc" => "2.0",
            "method" => $method,
            "params" => [
                "apiKey" => self::API_KEY,
                'n' => $n,
                "size" => $size
            ],
            "id" => random_int(0, 99999)
        ];
        $result = $this->request($post_data);
        return $result;
    }

    /**
     * @param int $n - Кол-во генерируемых decimal чисел [1, 10000]
     * @param int $decimalPlaces - Кол-во знаков после запятой [1, 14]
     * @param bool $replacement - Повторения [true, false]
     * @return mixed
     * @throws Exception
     */
    public function generateDecimalFractions(int $n = 1, int $decimalPlaces = 8, bool $replacement = true)
    {
        $method = 'generateDecimalFractions';
        $post_data = [
            "jsonrpc" => "2.0",
            "method" => $method,
            "params" => [
                "apiKey" => self::API_KEY,
                'n' => $n,
                'decimalPlaces' => $decimalPlaces,
                'replacement' => $replacement
            ],
            "id" => random_int(0, 99999)
        ];
        $result = $this->request($post_data);
        return $result;
    }

    /**
     * @param int $n - Кол-во генерируемых Gaussians nums []
     * @param float $mean
     * @param float $standardDeviation
     * @param int $significantDigits
     * @return mixed
     * @throws Exception
     */
    public function generateGaussians(int $n = 1, float $mean = 0.0, float $standardDeviation = 1.0, int $significantDigits = 8)
    {
        $method = 'generateGaussians';
        $post_data = [
            "jsonrpc" => "2.0",
            "method" => $method,
            "params" => [
                "apiKey" => self::API_KEY,
                "n" => $n,
                "mean" => $mean,
                "standardDeviation" => $standardDeviation,
                "significantDigits" => $significantDigits
            ],
            "id" => random_int(0, 99999)
        ];
        $result = $this->request($post_data);
        return $result;
    }
}