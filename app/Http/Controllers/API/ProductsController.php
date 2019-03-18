<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Products;
use App\Product_images;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Products::orderBy('created_at','desc')->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $attributes = request()->validate([
            'productName' => ['required', 'min:3'],
            'productNameEn' => ['required', 'min:3'],
            'productDesc' => ['required'],
            'productDescEn' => ['required'],
            'introText' => ['required'],
            'introTextEn' => ['required'],
            'productText' => ['required'],
            'productTextEn' => ['required'],
            'altTag' => ['required'],
            'altTagEn' => ['required'],
        ]);
        
        $this->validate($request,[
            'intro_image' => ['required'],
            'cover_image' => ['required'],
            'images' => ['required']
        ]);

        // intro image
        $attributes['user_id'] = auth('api')->id();
        $introImgName = time().'.' . explode('/', explode(':', substr($request->intro_image, 0, strpos($request->intro_image,';')))[1])[1];
        \Image::make($request->intro_image)->save(public_path('img/').$introImgName);
        $request->merge(['intro_image' => $introImgName]);
        
        $attributes['introImage'] = $request['intro_image'];
            
        // cover image
        $coverImgName = time().'.' . explode('/', explode(':', substr($request->cover_image, 0, strpos($request->cover_image,';')))[1])[1];
        \Image::make($request->cover_image)->save(public_path('img/').$coverImgName);
        $request->merge(['cover_image' => $coverImgName]);
        
        $attributes['coverImage'] = $request['cover_image'];
        $attributes['active'] = false;

        $product = Products::create($attributes);
      
        if (count($request->images)){
            foreach($request->images as $image){
                $image->store('productImgs', ['disk' => 'public_images']); //public_images sam definisao u filesystem, tu će da mi smješta slike 
                
                $attr = [ 
                    'image_name' => $image->hashName(),
                    'products_id' => $product->id
                ];

                $product_image = Product_images::create($attr);
            }
        }


        return ['message' => 'BravoO'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete product images
        $productImages = Product_images::where('products_id', $id)->get();
        foreach ($productImages as $prodImg) {
            $imgToDelete = public_path('img/productImgs/').$prodImg->image_name;
            if (file_exists($imgToDelete)){
                @unlink($imgToDelete);
            }
        }

        
        $product = Products::findOrFail($id);
        
        //delete cover img
         $coverImageToDelete = public_path('img/').$product->coverImage;
         if (file_exists($coverImageToDelete)) {
             @unlink($coverImageToDelete);
         }
        
        //delete intro img
         $introImageToDelete = public_path('img/').$product->introImage;
         if (file_exists($introImageToDelete)) {
             @unlink($introImageToDelete);
         }
        
        $product->delete();

        return ['message' => 'Proizvod je obrisan'];
    }
}
