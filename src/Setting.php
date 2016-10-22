<?php

namespace Humweb\Settings;

use Humweb\Settings\Storage\SettingsStorageInterface;
use Humweb\Settings\Encoders\EncoderInterface;
use Illuminate\Support\Facades\Cache;

class Setting
{
    protected $storage;
    protected $encoder;

    protected $resourceId = 0;
    protected $resourceType = 'system';

    public function __construct(SettingsStorageInterface $storage = null, EncoderInterface $encoder = null)
    {
        $this->storage = $storage;
        $this->encoder = $encoder;
    }

    /**
     * Set config value.
     *
     * @param $key
     * @param array|string $val
     */
    public function set($key, $val = '')
    {
        list($type, $key) = $this->parseKey($key);

        $str = 'settings.section.'.$type;

        if (Cache::has($str)) {
            Cache::forget($str);
        }

        $this->storage->set($key, $val, $type);
    }

    /**
     * Get config value.
     *
     * @param $key
     *
     * @return mixed
     */
    public function get($key)
    {
        list($type, $key) = $this->parseKey($key);

        $val = $this->storage->get($key, $type);

        return $val;
    }

    public function getSection($section)
    {
        $cacheKey = 'settings.section.'.$section;
        $valueList = [];
        $vals = Cache::remember($cacheKey, 60, function () use ($section) {
            return $this->storage->get('*', $section);
        });

        if (!empty($vals)) {
            foreach ($vals as $val) {
                $key = $section.'.'.$val['key'];
                $valueList[$key] = $val['val'];
            }
        }

        return $valueList;
    }

    /**
     * Get config value.
     *
     * @param $key
     *
     * @return mixed
     */
    public function getVal($key)
    {
        list($type, $key) = $this->parseKey($key);
        $val = $this->storage->getVal($key, $type);

        return $val;
    }

    protected function parseKey($key)
    {
        if (strpos($key, '.') !== false) {
            return explode('.', $key);
        } else {
            return ['system', $key];
        }
    }
}
