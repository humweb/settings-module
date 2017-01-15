<?php

namespace Humweb\Settings\Encoders;

interface EncoderInterface
{
    public function encode($value);


    public function decode($value);


    public function type();


    public function isEncoded($str);
}
