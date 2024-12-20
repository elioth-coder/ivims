<?php

namespace App\Models;

use App\Casts\UpperCase;
use Illuminate\Database\Eloquent\Model;

class VehicleBodyType extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'type' => UpperCase::class,
        ];
    }
}
