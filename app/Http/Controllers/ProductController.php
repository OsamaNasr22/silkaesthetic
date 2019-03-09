<?php

namespace App\Http\Controllers;

use App\Category;
use App\Image;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    static $id;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show');
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

        $product->description = htmlspecialchars($request['product_description']);

        $product->category_id = $request['category_id'];



        //add cover if exists
        if ($cover = $request->file('cover')){
            $coverImg= explode('/',Storage::putFile('public\product', $cover));
            $product->cover = last($coverImg);
        }


        //add extra images

        if ($images=$request->file('extraImages')){
            $arr_images=[];
            for ($i=0,$c=count($images);$i<$c;$i++){
                $img= explode('/', Storage::putFile('public/extra_images',$images[$i]));
                $arr_images[]=last($img);
            }
            $product->extra_images= ($arr_images)? implode(',',$arr_images): null;

        }
        //add slug
        $product->slug= $request['product_slug'];


        $state = $product->save();
        //add images if founded
        if ($state) {
//            $images = ($request->has('image')) ? $request->file('image') : null;
            if ($images= $request->file('image')){
                for ($i = 0; $i < count($images); $i++) {
                    $img = new Image();
                    $productImg= explode('/',Storage::putFile('public\product', $images[$i]));
                    $img->image_url = last($productImg);
                    $product->images()->save($img);
                }
            }
////            $images = (! is_null($images)) ? (is_array($images))? $request->file('image') :[$request->file('image')] : null;
//            if(!is_null($images)){
//                for ($i = 0; $i < count($images); $i++) {
//                    $img = new Image();
//                    $img->image_url = Storage::putFile('public\product', $images[$i]);
//                    $product->images()->save($img);
//                }
//            }

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
        $settings = (new  SettingController())->prepareAllSettings();
        $product=$this->prepareProduct($product);

        return view('blog.pages.product',compact('settings','product'));

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
        static::$id= $product->id;
        $images= $product->images->toArray();

        for($i=0 ; $i<count($images); $i++){
            $images[$i]['image_url']= asset("storage/product/" .$images[$i]['image_url']) ;
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
            $product->description= htmlspecialchars($request['product_description']);
            $product->category_id= $request['category_id'];
        $cover= ($request->has('cover'))? $request->file('cover'):null;




        //add cover if exists
        if ($cover = $request->file('cover')){
            Storage::delete('public/product/'.$product->cover);
            $coverImg= explode('/',Storage::putFile('public\product', $cover));
            $product->cover = last($coverImg);
        }else{
            $product->cover = $product->cover;
        }



        if ($images=$request->file('extraImages')){
            $product->extra_images=explode(',',$product->extra_images);
            $arr_images=is_array($product->extra_images)?$product->extra_images : [];
            for ($i=0,$c=count($images);$i<$c;$i++){
                $img= explode('/', Storage::putFile('public/extra_images',$images[$i]));
                $arr_images[]=last($img);
            }

            $product->extra_images= ($arr_images)? implode(',',array_filter($arr_images)): null;
        }
        //add slug
        $product->slug= $request['product_slug'];
        if($product->update()){
//                $images = ($request->has('image')) ? $request->file('image') : null;
//                $images = (! is_null($images)) ? (is_array($images))? $request->file('image') :[$request->file('image')] : null;
//                if(!is_null($images)){
//                    for ($i = 0; $i < count($images); $i++) {
//                        $img = new Image();
//                        $img->image_url = Storage::putFile('public\product', $images[$i]);
//                        $product->images()->save($img);
//                    }
//                }


            if ($images= $request->file('image')){
                for ($i = 0; $i < count($images); $i++) {
                    $img = new Image();
                    $productImg= explode('/',Storage::putFile('public\product', $images[$i]));
                    $img->image_url = last($productImg);
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
        if ($images=$product->extra_images){
            $images=explode(',',$images);
            $images=array_map(function($image){
                return 'public/extra_images/'.$image;
            },$images);
        }
        foreach ($product->images->toArray() as $image){
            $deleted[]='public/product/'.$image['image_url'];
        }
        $deleted[]= 'public/product/'.$product->cover;
        if ($images) $deleted = array_merge($deleted,$images);
        Storage::delete($deleted);
        return ($product->delete())? response()->json('product deleted successfully',200):response()->json('product deleted successfully',
            400);
    }
    private function prepareProduct(Product $product){
        $data= $product->toArray();
       if ($data['extra_images']){
           $arr=explode(',',$data['extra_images']);
           $extra_images=array_map(function($image){
               return 'storage/extra_images/'.$image;
           },$arr);
           $data['extra_images']=$extra_images;
       }
        $data['cover']= asset("storage/product/" .$data['cover']);

       $data['images']=$product->images->toArray();
//       dd($data);
        return $data;
    }
    public function deleteImage($id){
        $image= Image::find($id);
        if(!$image) return response()->json('this image not found');
        Storage::delete($image->image_url);
        return ($image->delete())? response()->json('Image deleted successfully',200):response()->json('Delete image faild try again',200);
    }

        public function deleteExtra($id,$image){

        $product= Product::find($id);

        Storage::delete('public/extra_images/'.$image);
        $arr= explode(',' ,$product->extra_images);
        $arr = array_diff($arr,[$image]);
        $extra=count($arr)>0 ? implode(',',$arr):null;
        $product->extra_images = $extra ;
        $product->update();
        return response()->json('done',200);
        }

}
