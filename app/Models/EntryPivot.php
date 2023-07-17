<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EntryPivot extends Pivot
{
    use HasFactory;
    protected $table ='product_product_entry';
    public static function boot()
    {
        parent::boot();
        static::created(function($item){
//            dd($item);
        });

    }
}
