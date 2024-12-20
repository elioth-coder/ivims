<?php

namespace App\Models;

use App\Casts\LowerCase;
use App\Casts\UpperCase;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';

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
            'email'   => LowerCase::class,
            'address' => UpperCase::class,
        ];
    }
}
