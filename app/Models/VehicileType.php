<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class VehicileType extends Model
{
    protected $table = 'vehicile_types';
    protected $fillable = [
        'vehicile_code',
        'vehicile_name',
        'first_hour_price',
        'next_hour_price',
        'is_flat_price',
        'created_by',
        'updated_by'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($user) {
            $user->created_by = Auth::user()->id;
            $user->updated_by = Auth::user()->id;
        });
        static::updating(function ($user) {
            $user->updated_by = Auth::user()->id;
        });
    }

}
