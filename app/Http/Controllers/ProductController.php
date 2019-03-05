<?php

namespace App\Http\Controllers;

use App\Category;
use App\Image;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //

        return view('dashboard.pages.allProduct',['products'=> Product::all()->toArray()]);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.pages.newProduct',['categories'=>Category::all()->toArray()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request, [
            'product_title'=>'',
            'product_description'=>'',
            'category_id'=>'',
            'cover'=>'image|max:20480',
            'image.*'=>'image|max:15360'
        ]);

        $product = new Product();
        $product->title = $request['product_title'];
        $product->description = $request['product_description'];
        $product->category_id = $request['category_id'];
        $cover= ($request->has('cover'))?$request->file('cover'):null;
        $product->cover = (!is_null($cover))?Storage::putFile('public\product', $cover) : $cover;

        $state = $product->save();
        if ($state) {
            $images = ($request->has('image')) ? $request->file('image') : null;

//            $images = (! is_null($images)) ? (is_array($images))? $request->file('image') :[$request->file('image')] : null;
            if(!is_null($images)){
                for ($i = 0; $i < count($images); $i++) {
                    $img = new Image();
                    $img->image_url = Storage::putFile('public\product', $images[$i]);
                    $product->images()->save($img);
                }
            }
            return redirect()->back()->with(['success' => 'product added successfully']);
        }else{
            return redirect()->back()->with(['fail' => 'wrong in add product try again']);
        }


    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        $images= $product->images->toArray();
        for($i=0 ; $i<count($images); $i++){
            $img= explode('\\',$images[$i]['image_url']);
            $images[$i]['image_url']= asset("storage/" .end($img)) ;
        }
        $data= $this->prepareProduct($product);

        return view('dashboard.pages.editProduct',['product'=>$data ,'categories'=>Category::all()->toArray() ,'images'=>$images]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

            $this->validate($request, [
                'product_title'=>'',
                'product_description'=>'',
                'category_id'=>'',
                'cover'=>'',
                'image'=>''
            ]);

            $product->title= $request['product_title'];
            $product->description= $request['product_description'];
            $product->category_id= $request['category_id'];
        $cover= ($request->has('cover'))? $request->file('cover'):null;

        if(is_null($cover)){
            $product->cover = $product->cover;
        }else{
            //delete old cover from server
            Storage::delete($product->cover);
            //add new one
           $product->cover= Storage::putFile('public\product', $cover);
        }

            if($product->update()){
                $images = ($request->has('image')) ? $request->file('image') : null;
                $images = (! is_null($images)) ? (is_array($images))? $request->file('image') :[$request->file('image')] : null;
                if(!is_null($images)){
                    for ($i = 0; $i < count($images); $i++) {
                        $img = new Image();
                        $img->image_url = Storage::putFile('public\product', $images[$i]);
                        $product->images()->save($img);
                    }
                }
                return redirect()->back()->with(['success' => 'product updated successfully']);
            }else{

                return redirect()->back()->with(['fail' => 'wrong in update product try again']);
            }








    }

    /**
     * Remove the specified resource from storage
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $deleted=[];
        foreach ($product->images->toArray() as $image){
            $deleted[]=$image['image_url'];
        }
        $deleted[]= $product->cover;
        Storage::delete($deleted);
        return ($product->delete())? response()->json('product deleted successfully',200):response()->json('product deleted successfully',
            400);
    }
    private function prepareProduct(Product $product){
        $data= $product->toArray();
        $img= explode('\\', $data['cover']);
        $data['cover']= asset("storage/" .end($img));
        return $data;
    }
    public function deleteImage($id){
        $image= Image::find($id);
        if(!$image) return response()->json('this image not found');
        Storage::delete($image->image_url);
        return ($image->delete())? response()->json('Image deleted successfully',200):response()->json('Delete image faild try again',200);
    }

}
