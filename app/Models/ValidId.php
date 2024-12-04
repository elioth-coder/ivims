<?php

namespace App\Models;

use App\Casts\UpperCase;
use Illuminate\Database\Eloquent\Model;

class ValidId extends Model
{
    protected $table = 'valid_ids';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'code'   => UpperCase::class,
            'description' => UpperCase::class,
        ];
    }

}
