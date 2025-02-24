<?php

namespace App\Models;

use App\Casts\UpperCase;
use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    protected $table = 'ticket_categories';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'code' => UpperCase::class,
            'name' => UpperCase::class,
        ];
    }
}
