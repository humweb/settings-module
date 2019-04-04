<?php

namespace Humweb\Settings\Storage;

use Illuminate\Database\Eloquent\Model;

class EloquentModel extends Model
{
    public $incrementing = false;
    public $timestamps   = true;

    protected $table      = 'settings';
    protected $softDelete = false;
    protected $primaryKey = null;
    protected $attributes = [
        'configurable_id' => 0
    ];

    protected $fillable = array('key', 'val', 'configurable_type', 'configurable_id', 'user_id');


}
