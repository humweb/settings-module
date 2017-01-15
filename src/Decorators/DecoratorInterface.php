<?php

namespace Humweb\Settings\Decorators;

/**
 * DecoratorInterface.php.
 *
 * Date: 8/18/14
 * Time: 11:21 PM
 */
interface DecoratorInterface
{
    public function label($for, $name, $attr = []);


    public function text($name, $val = '', $attr = []);


    public function textarea($name, $val = '', $attr = []);


    public function select($name, $data, $val = '', $attr = []);


    public function controlGroup($content = '');
}
