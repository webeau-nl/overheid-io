<?php

namespace Webeau\Ovio;

use \Exception;

abstract class Ovio
{
    protected $base_url = 'https://overheid.io/';
    protected $api_key;
    protected $api_name;

    public function __construct($key)
    {
        if (empty($key)) {
            throw new Exception('No API key given.');
        }

        $this->api_key = $key;
    }

    protected function fetch($type, $query)
    {
        $url = $this->base_url . $type . '/' . $this->api_name . '/' . $query;

        $ch  = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'ovio-api-key: ' . $this->api_key
        ]);

        $data = curl_exec($ch);

        if (curl_errno($ch) !== 0) {
            return null;
        }
        curl_close($ch);

        return json_decode($data);
    }
}
