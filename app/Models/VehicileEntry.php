<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class VehicileEntry extends Model
{
    protected $table = 'vehicile_entries';

    protected $fillable = [
        'gatekeeper_code',
        'vehicile_license_plate',
        'vehicile_type',
        'entry_time',
        'exit_time',
        'created_by',
        'modified_by'
    ];

    protected $casts = [
        'entry_time' => 'datetime'
    ];

    public $timestamps = false;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
regen:
        $uniqueCode = Carbon::now()->format('YmdHis') . rand(1000, 9999) . '-' . rand(1000, 9999);
        if (!empty(VehicileEntry::where('gatekeeper_code', $uniqueCode)->first())) {
            goto regen;
        }

        static::creating(function ($user) use ($uniqueCode) {
            $user->gatekeeper_code = $uniqueCode;
            $user->entry_time = Carbon::now();
            $user->modified_by = Auth::user()->id;
        });
        static::updating(function ($user) {
            $user->modified_by = Auth::user()->id;
        });
    }

    public function vehicileType()
    {
        return $this->hasOne(VehicileType::class, 'id', 'vehicile_type');
    }
}
