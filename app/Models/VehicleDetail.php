<?php

namespace App\Models;

use App\Casts\UpperCase;
use Illuminate\Database\Eloquent\Model;

class VehicleDetail extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'color'     => UpperCase::class,
            'make'      => UpperCase::class,
            'model'     => UpperCase::class,
            'body_type' => UpperCase::class,
        ];
    }
}
