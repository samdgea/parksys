<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'config';
    protected $fillable = [
        'config_name',
        'config_value'
    ];

    protected $casts = [
        'config_value' => 'object'
    ];

    /**
     * Get the config value.
     *
     * @return string
     */
    public function getConfigAttribute()
    {
        return json_decode($this->config_value);
    }
}
