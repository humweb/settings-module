<?php

namespace Humweb\Settings\Storage;

class DbStorage implements SettingsStorageInterface
{
    /**
     * @var string
     */
    protected $model = 'Humweb\\Settings\\Storage\\EloquentModel';

    public function __construct()
    {
    }

    /**
     * Get config value.
     *
     * @param string      $key
     * @param string|null $type
     *
     * @return mixed
     */
    public function get($key, $type = null, $fields = '*')
    {
        $model = $this->getModel()->select($fields);

        if ($key == '*') {
            return $model->where('configurable_type', $type)->get()->toArray();
        }

        return $model->where('key', $key)->where('configurable_type', $type)->first()->toArray();
    }

    public function getVal($key, $type = null)
    {
        return $this->get($key, $type, 'val')['val'];
    }

    /**
     * Set config value.
     *
     * @param        $key  string
     * @param        $val  array|string
     * @param string $type
     *
     * @return int
     */
    public function set($key, $val, $type = 'str')
    {
        // Check if setting exists
        $setting = $this->getModel()->where('key', $key)->where('configurable_type', $type)->first();

        if (is_null($setting)) {
            //Create a new setting entry
            $setting = $this->getModel()->create([
                'key' => $key,
                'val' => $val,
                'configurable_type' => $type,
            ]);
        } else {
            //Update
            $setting = $this->getModel()->where('key', $key)->where('configurable_type', $type)->update(['val' => $val]);
        }

        return $setting;
    }

    /**
     * Creates new model.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function getModel($data = [])
    {
        $class = '\\'.ltrim($this->model, '\\');

        return new $class($data);
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }
}
