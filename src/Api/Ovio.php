<?php

namespace Webeau\Ovio;

use \Exception;

abstract class Ovio
{
    protected $base_url = 'https://overheid.io';
    protected $api_key;
    protected $api_name;

    protected $last_url;
    protected $last_data = null;

    public function __construct($key)
    {
        if (empty($key)) {
            throw new Exception('No API key given.');
        }

        $this->api_key = $key;
    }

    public function next() {
        if (isset($this->last_data->_links->next->href)) {
            return $this->call($this->base_url . $this->last_data->_links->next->href);
        }
    }

    public function prev() {
        if (isset($this->last_data->_links->prev->href)) {
            return $this->call($this->base_url . $this->last_data->_links->prev->href);
        }
    }

    public function first() {
        if (isset($this->last_data->_links->first->href)) {
            return $this->call($this->base_url . $this->last_data->_links->first->href);
        }
    }
    public function last() {
        if (isset($this->last_data->_links->last->href)) {
            return $this->call($this->base_url . $this->last_data->_links->last->href);
        }
    }

    protected function fetch($type, $query)
    {
        $url = $this->base_url . '/' . $type . '/' . $this->api_name . '/' . $query;

        return $this->call($url);
    }

    protected function call($url)
    {
        if ($url === $this->last_url) {
            return $this->last_data;
        }

        $this->last_url = $url;

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

        $this->last_data = json_decode($data);

        return $this->last_data;
    }
}
