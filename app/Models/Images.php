<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_name',
        'created_at',
        'updated_at',

    ];
    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}
