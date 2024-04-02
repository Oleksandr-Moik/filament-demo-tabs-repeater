<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'size_table',
        'render_columns',
    ];

    protected function casts(): array
    {
        return [
            'size_table' => 'array',
        ];
    }
}
