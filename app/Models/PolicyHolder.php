<?php

namespace App\Models;

use App\Casts\LowerCase;
use App\Casts\UpperCase;
use Illuminate\Database\Eloquent\Model;

class PolicyHolder extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'id_type'     => UpperCase::class,
            'id_number'   => UpperCase::class,
            'business'    => UpperCase::class,
            'first_name'  => UpperCase::class,
            'middle_name' => UpperCase::class,
            'last_name'   => UpperCase::class,
            'suffix'      => UpperCase::class,
            'gender'      => UpperCase::class,
            'address'     => UpperCase::class,
            'email'       => LowerCase::class,
        ];
    }
}
