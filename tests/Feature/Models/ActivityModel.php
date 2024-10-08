<?php

namespace Mlbrgn\LaravelFormComponents\Tests\Feature\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityModel extends Model
{
    public $casts = [
        'date_b' => 'date',
        'date_c' => 'datetime',
        'date_d' => 'date:Y',
        'date_e' => 'datetime:Y-m',
    ];

    public array $dates = ['date_a'];
}
