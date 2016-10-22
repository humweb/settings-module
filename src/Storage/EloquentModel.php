<?php

namespace Humweb\Settings\Storage;

use Illuminate\Database\Eloquent\Model;

class EloquentModel extends Model
{
    protected $table = 'settings';

    /**
     * primaryKey
     *
     * @var integer
     * @access protected
     */
    protected $primaryKey = null;

    protected $attributes = [
        'configurable_id' => 0
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public    $timestamps = true;
    protected $softDelete = false;
    protected $fillable   = array('key', 'val', 'configurable_type', 'configurable_id', 'user_id');
}
