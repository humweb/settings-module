<?php

namespace Humweb\Settings;

use Humweb\Settings\Decorators\Bootstrap;

/**
 * Settings.php.
 *
 * Date: 8/10/14
 * Time: 9:33 PM
 */
class SettingsSchema
{
    protected $settings = [];

    protected $values;
    protected $decorator;

    public function __construct($values = [], $decorator = null)
    {
        $this->decorator = $decorator ?: new Bootstrap();

        $this->setValues($values);
    }

    /**
     * Get settings values.
     *
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Set values.
     *
     * @param mixed $values
     */
    public function setValues($values)
    {
        if (!empty($values)) {
            $valueList = [];

            foreach ($values as $val) {
                $key = $val['configurable_type'].'.'.$val['key'];
                $valueList[$key] = $val['val'];
            }
            $this->values = $valueList;
        }
    }

    public function isAcceptableKey($key)
    {
        return isset($this->settings[$key]);
    }

    public function buildForm()
    {
        $form = '';

        foreach ($this->settings as $key => $setting) {
            //Label
            $content = $this->decorator->label($key, $setting['label']);

            $value = isset($this->values[$key]) ? $this->values[$key] : '';
            $key = 'settings['.$key.']';

            //Field
            switch ($setting['type']) {
                case 'text':
                    $content .= $this->decorator->text($key, $value);
                break;

                case 'textarea':
                    $content .= $this->decorator->textarea($key, $value);
                break;

                case 'select':
                    $content .= $this->decorator->select($key, $setting['options'], $value);
                break;

            }

            //Wrapper
            $form .= $this->decorator->controlGroup($content);
        }

        return $form;
    }

    /**
     * @return array
     */
    public function get()
    {
        return $this->settings;
    }

    /**
     * @param array $settings
     */
    public function set($settings)
    {
        $this->settings = $settings;
    }
}
