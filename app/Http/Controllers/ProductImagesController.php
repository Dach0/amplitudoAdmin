<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product_images;

class ProductImagesController extends Controller
{
    public function upload(Request $req)
    {
    //     $this->validate($req,[
    //         'images' => ['required']
    //     ]);

    //     $poruka = '';
    //     if (count($req->images)){
    //         foreach($req->images as $image){
    //             $image->store('productImgs', ['disk' => 'public_images']); //public_images sam definisao u filesystem, tu će da mi smješta slike 
                
    //             $attr = [ 
    //                 'image_name' => $image->hashName(),
    //                 'products_id' => $req->products_id
    //             ];

    //             $product_image = Product_images::create($attr);
    //         }
    //     }

    //     return ['message', 'I slike su sacuvane'];
        
    }
}
