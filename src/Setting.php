<?php

namespace Humweb\Settings;

use Humweb\Settings\Encoders\EncoderInterface;
use Humweb\Settings\Storage\SettingsStorageInterface;
use Illuminate\Support\Facades\Cache;

class Setting
{
    protected $storage;
    protected $encoder;

    protected $resourceId   = 0;
    protected $resourceType = 'system';


    public function __construct(SettingsStorageInterface $storage = null, EncoderInterface $encoder = null)
    {
        $this->storage = $storage;
        $this->encoder = $encoder;
    }


    /**
     * Set config value.
     *
     * @param              $key
     * @param array|string $val
     */
    public function set($key, $val = '')
    {
        list($type, $key) = $this->parseKey($key);

        if (Cache::has('settings.section.'.$type)) {
            Cache::forget('settings.section.'.$type);
        }

        $this->storage->set($key, $val, $type);
    }


    protected function parseKey($key)
    {
        if (strpos($key, '.') !== false) {
            return explode('.', $key);
        } else {
            return ['system', $key];
        }
    }


    /**
     * Get config record.
     *
     * @param $key
     *
     * @return mixed
     */
    public function get($key, $default = 'default')
    {
        list($type, $key) = $this->parseKey($key);

        $val = $this->storage->get($key, $type);

        return $val ?? $default;
    }

    /**
     * Get config value.
     *
     * @param $key
     *
     * @return mixed
     */
    public function getVal($key, $default = 'default')
    {
        list($type, $key) = $this->parseKey($key);

        $val = $this->storage->getVal($key, $type);

        return $val ?? $default;
    }


    /**
     * @param $section
     *
     * @return \Illuminate\Support\Collection
     */
    public function getSection($section)
    {
        $cacheKey = 'settings.section.'.$section;
        $settings = [];
        $vals     = Cache::remember($cacheKey, 60, function () use ($section) {
            return $this->storage->get('*', $section);
        });

        if ( ! empty($vals)) {
            foreach ($vals as $val) {
                $key            = $section.'.'.$val['key'];
                $settings[$key] = $val['val'];
            }
        }

        return collect($settings);
    }
}
