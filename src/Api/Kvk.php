<?php

namespace Webeau\Ovio;

class Kvk extends Ovio
{
    protected $api_name = 'kvk';

    /**
     * Fetch information by kvk number
     *
     * Example:
     * $ovio->get('123123');
     *
     * @param $kvk_nr
     * @param null $sub_nr
     * @return \stdClass|null
     *
     */
    public function get($kvk_nr, $sub_nr = null)
    {
        if (is_null($sub_nr)) {
            $sub_nr = '0000';
        }

        return $this->fetch('api', $kvk_nr . '/' . $sub_nr);
    }

    /**
     * Search kvk database
     *
     * Example:
     * $ovio->search(['filter' => ['postcode' => '3083cz']]);
     *
     * @param array $params
     * @return mixed|null
     */
    public function search(array $params)
    {
        return $this->fetch('api', '?' . http_build_query($params));
    }

    /**
     * Simple search kvk database
     *
     * Example:
     * $ovio->searchBy('postcode', '3083cz');
     *
     * @param string $key
     * @param string $value
     * @return \stdClass|null
     */
    public function searchBy($key, $value) {
        return $this->search(['filter' => [$key => $value]]);
    }

    /**
     * Get suggestions for given search string
     *
     * Example:
     * $ovio->suggest('oudet', ['size' => 10, 'fields' => ['handelsnaam', 'straat', 'dossiernummer']])
     *
     * @param string $search
     * @param array $params
     * @return \stdClass|null
     *
     */
    public function suggest($search, array $params = [])
    {
        $query_string = '';

        if (count($params)) {
            $query_string = '?' . http_build_query($params);
        }

        return $this->fetch('suggest', $search . $query_string);
    }
}
