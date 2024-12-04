<?php

namespace App\Models;

use App\Casts\LowerCase;
use App\Casts\UpperCase;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'code'    => UpperCase::class,
            'name'    => UpperCase::class,
            'address' => UpperCase::class,
            'origin'  => LowerCase::class,
            'email'   => LowerCase::class,
        ];
    }
}
