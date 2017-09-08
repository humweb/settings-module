<?php

namespace Humweb\Settings\Decorators;

use Collective\Html\FormFacade as Form;

class Bootstrap implements DecoratorInterface
{
    public function label($for, $name, $attr = [])
    {
        return Form::label($for, $name, $attr);
    }


    public function text($name, $val = '', $attr = [])
    {
        $attr = $this->setOrAppendClass($attr, 'form-control');

        return Form::text($name, $val, $attr);
    }


    protected function setOrAppendClass($attr, $class)
    {
        if (isset($attr['class'])) {
            $attr['class'] .= ' '.$class;
        } else {
            $attr['class'] = $class;
        }

        return $attr;
    }


    public function textarea($name, $val = '', $attr = [])
    {
        $attr = $this->setOrAppendClass($attr, 'form-control');

        return Form::textarea($name, $val, $attr);
    }


    public function select($name, $data, $val = '', $attr = [])
    {
        $attr = $this->setOrAppendClass($attr, 'form-control');

        return Form::select($name, $data, $val, $attr);
    }


    public function controlGroup($content = '')
    {
        return '<div class="form-group">'.$content.'</div>';
    }


    public function helpText($content)
    {
        return '<span class="form-text text-muted">'.$content.'</span>';
    }

}
