<?php

namespace Webeau\Ovio;

class Rdw extends Ovio
{
    protected $api_name = 'voertuiggegevens';

    /**
     * Fetch information by car number
     *
     * Example:
     * $ovio->get('AB-12-CD');
     *
     * @param $vrn
     * @return \stdClass|null
     *
     */
    public function get($vrn)
    {
        return $this->fetch('api', $vrn);
    }

    /**
     * Search 'voertuiggegevens' database
     *
     * Example:
     * $ovio->search(['filter' => ['merk' => 'bmw']]);
     *
     * @param array $params
     * @return \stdClass|null
     */
    public function search(array $params)
    {
        return $this->fetch('api', '?' . http_build_query($params));
    }

    /**
     * Simple search 'voertuiggegevens' database
     *
     * Example:
     * $ovio->searchBy('merk', 'bmw');
     *
     * @param string $key
     * @param string $value
     * @return \stdClass|null
     */
    public function searchBy($key, $value) {
        return $this->search(['filter' => [$key => $value]]);
    }
}
