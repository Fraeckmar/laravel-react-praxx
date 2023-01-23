<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all()->reduce(function($carry, $item){
            $item->images = !empty($item->images) ? unserialize($item->images) : [];
            $carry[] = $item;
            return $carry;
        });
        return new ProductResource($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->images = is_array($request->images) ? serialize($request->images) : $request->images;
        $product->datetime = date('Y-m-d h:i:s', strtotime($request->datetime));
        $product->save();
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->images = $product->images ? unserialize($product->images) : [];
        $product->datetime = date('Y-m-d H:i', strtotime($product->datetime));
        if (!empty($product->images)) {
            $imagesUrl = [];
            foreach ($product->images as $fileName) {
                if (env('APP_ENV') == 'local') {
                    $imagesUrl[] = 'http://localhost/praxxys2/public/images/'.$fileName;
                } else {
                    $imagesUrl[] = public_path('images/').$fileName;
                }                
            }
            $product->imagesUrl = $imagesUrl;
        }
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->images = is_array($request->images) ? serialize($request->images) : $request->images;
        $product->datetime = date('Y-m-d h:i:s', strtotime($request->datetime));
        $product->save();
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['Successfully deleted']);
    }

    function uploadImages(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'name' => 'required:string'
        ]);

        $imageNames = [];
        if (!empty($request->images)) {
            foreach ($request->images as $idx => $image) {
                $idx++;
                $fileName = $request->name.'_'.$idx.'.'.$image->extension(); 
                $image->move(public_path('images'), $fileName);
                $imageNames[] = $fileName;
            }
            return response()->json($imageNames);
        } else {
            return response(['message' => 'Unable to save images'], 500);
        }        
    }
}
