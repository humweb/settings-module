<?php

namespace Humweb\Settings\Encoders;

class JsonEncoder implements EncoderInterface
{
    public function type()
    {
        return 'json';
    }


    public function encode($value)
    {
        return json_encode($value);
    }


    public function decode($value)
    {
        return json_decode($value);
    }


    public function isEncoded($str)
    {
        json_decode($str);

        return (json_last_error() == JSON_ERROR_NONE);
    }
}
