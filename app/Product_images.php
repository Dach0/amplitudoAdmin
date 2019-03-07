<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Products;

class Product_images extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }   
}
