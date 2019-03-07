<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Product_images;

class Products extends Model
{
   
protected $guarded = [];

public function product_images()
{
    return $this->hasMany(Product_images::class);
}


}
