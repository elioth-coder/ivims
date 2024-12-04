<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehiclePremium extends Model
{
    protected $table = 'vehicle_premiums';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
}
