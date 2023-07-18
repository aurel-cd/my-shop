<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Images;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Product extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'product_name',
        'product_desc',
        'price',
        'created_at',
        'updated_at',
        'category_id',
        'brands_id',
    ];

    public function productEntries()
    {
        return $this->belongsToMany(ProductEntry::class)
            ->using(EntryPivot::class);
    }

    public function images()
    {
        return $this->belongsToMany(Images::class)
            ->using(ImagePivot::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brands::class, 'brands_id');
    }
}
