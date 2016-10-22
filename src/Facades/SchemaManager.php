<?php

namespace Humweb\Settings\Facades;

use Illuminate\Support\Facades\Facade;

class SchemaManager extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'settings.schema.manager';
    }
}
