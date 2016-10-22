<?php

namespace Humweb\Settings\Storage;

interface SettingsStorageInterface
{
    /**
     * Get config value.
     *
     * @param $key string
     *
     * @return mixed
     */
    public function get($key);

    /**
     * Set config value.
     *
     * @param $key string
     * @param $val array|string
     * @param string $encodeType
     */
    public function set($key, $val, $encodeType = 'str');
}
