<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'created_at',
        'updated_at',
        'color_id',
        'size_id',
    ];

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }

    public function size()
    {
        return $this->belongsToMany(Size::class);
    }

    public function color()
    {
        return $this->belongsToMany(Color::class);
    }
}
