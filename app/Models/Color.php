<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'color_name',
        'created_at',
        'updated_at',

    ];

    public function colors()
    {
        return $this->belongsTo(ProductEntry::class);
    }
}
