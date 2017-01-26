<?php

namespace Humweb\Settings;

use Humweb\Settings\Decorators\Bootstrap;
use Humweb\Settings\Decorators\DecoratorInterface;

/**
 * SchemaManager.php.
 */
class SchemaManager
{
    protected $items = [];
    protected $schema;


    public function register($name, $class)
    {
        $this->items[$name] = $class;
        return $this;
    }


    public function get($name, $values = [], DecoratorInterface $decorator = null)
    {
        $schema = $this->items[$name];

        $decorator = $decorator ?: new Bootstrap();

        $obj = null;

        if (is_string($schema) and class_exists($schema)) {
            $obj = new $schema($values, $decorator);
        } elseif (is_array($schema)) {
            $obj = new SettingsSchema($values, $decorator);
            $obj->set($schema);
        } elseif (is_callable($schema)) {
            $obj = new SettingsSchema($values, $decorator);
            $obj->set($schema());
        } else {
            $obj = new $schema($values, $decorator);
        }

        return $obj;
    }


    /**
     * @return array
     */
    public function getClasses()
    {
        return $this->items;
    }


    /**
     * @param $classes
     */
    public function setClasses($classes)
    {
        $this->items = $classes;
    }
}
