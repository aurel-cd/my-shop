<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ImagePivot extends Pivot
{
    use HasFactory;
    protected $table ='image_product';
    public static function boot()
    {
        parent::boot();
        static::created(function($item){
//            dd($item);
        });

    }
}
