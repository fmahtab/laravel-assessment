<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected function casts(): array
    {
        return [
            'activities' => 'array',
        ];
    }
}
