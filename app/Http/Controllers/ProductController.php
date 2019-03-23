<?php

namespace App\Http\Controllers;

use App\Category;
use App\Image;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;
use Intervention\Image\Facades\Image as ImageResize;

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
        $this->middleware('auth')->except('show','products');
    }

    public function index()
    {
        //

        return view('dashboard.pages.allProduct',['products'=> Product::all()]);
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
            'product_title'=>'required|max:255',
            'product_description'=>'required|max:4000000000',
            'category_id'=>'required',
            'cover'=>'required|image|mimes:jpg,jpeg,png,gif|max:2000',
            'image.*'=>'nullable|image|max:15360',
            'product_slug'=>'nullable|string|max:255',
            'extra_images.*'=>'nullable|image|max:1024|mimes:jpg,jpeg,png'
        ]);

        $product = new Product();

        $product->title = $request['product_title'];

        $product->description = htmlspecialchars($request['product_description']);

        $product->category_id = $request['category_id'];



        //add cover if exists
        if ($cover = $request->file('cover')){

            //store image and return the full path of it
            $fullImageUrl=Storage::putFile('public/product', $cover);
            //create instance of image file
            $imageFile= new File(storage_path('app/'.$fullImageUrl));

            //make different resolution for different screen size
            $this->makeResize($imageFile,400);
            $this->makeResize($imageFile,550);
            $this->makeResize($imageFile,750);
            $this->makeResize($imageFile,1024);

            $coverImg= explode('/',$fullImageUrl);
            $product->cover = last($coverImg);
        }


        //add extra images

        if ($images=$request->file('extraImages')){
            $arr_images=[];
            for ($i=0,$c=count($images);$i<$c;$i++){
                //store image and return the full path of it

                $fullImageUrl=Storage::putFile('public/extra_images',$images[$i]);
                //create instance of image file

                $imageFile= new File(storage_path('app/'.$fullImageUrl));

                //make different resolution for different screen size
                $this->makeResize($imageFile,400,'extra_images');
                $img= explode('/',$fullImageUrl );

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

                    //store image and return the full path of it

                    $fullImageUrl=Storage::putFile('public/product', $images[$i]);
                    $productImg= explode('/',$fullImageUrl);
                    $img->image_url = last($productImg);
                    $product->images()->save($img);
                    if ($img->image_url){
                        //create instance of image file
                        $imageFile= new File(storage_path('app/'.$fullImageUrl));
                        //make different resolution for different screen size
                        $this->makeResize($imageFile,400);
                        $this->makeResize($imageFile,550);
                        $this->makeResize($imageFile,750);
                        $this->makeResize($imageFile,1024);
                    }
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
        $settings = (new  SettingController())->prepareAllSettings();
        $product=$this->prepareProduct($product);
//        dd($product);
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
                'product_title'=>'required|max:255',
                'product_description'=>'required|max:4000000000',
                'category_id'=>'required',
                'cover'=>'nullable|image|mimes:jpg,jpeg,png,gif|max:2000',
                'image.*'=>'nullable|image|max:15360',
                'product_slug'=>'nullable|string|max:255',
                'extra_images.*'=>'nullable|image|max:1024|mimes:jpg,jpeg,png'
            ]);

            $product->title= $request['product_title'];

            $product->description= htmlspecialchars($request['product_description']);

            $product->category_id= $request['category_id'];

            if (strlen($request['deleteImages'])>0){

                $ids= explode(',',$request['deleteImages']);
                foreach ($ids as $id){
                    $image= Image::find($id);
                    if ($image){
                        list($name,$ext)=explode('.',$image->image_url);
                        $deletedImages=[
                            'public/product/'.$image->image_url,
                            'public/product/'.$name .'@'. 400 . '.'.$ext,
                            'public/product/'.$name .'@'. 550 . '.'.$ext,
                            'public/product/'.$name .'@'. 750 . '.'.$ext,
                            'public/product/'.$name .'@'. 1024 . '.'.$ext,
                        ];
                        Storage::delete($deletedImages);
                        $image->delete();
                    }
                }

            }

            if (strlen($request['deleteExtraImages'])>0){
                $image= explode(',',$request['deleteExtraImages']);
                foreach ($image as $item){
                    list($name,$ext)=explode('.',$item);
                    $deletedImages =[
                        'public/extra_images/'.$item,
                        'public/extra_images/'.$name .'@'. 400 . '.'.$ext
                    ];

                    Storage::delete($deletedImages);
                    $arr= explode(',' ,$product->extra_images);
                    $arr = array_diff($arr,[$item]);
                    $extra=count($arr)>0 ? implode(',',$arr):null;
                    $product->extra_images = $extra ;
                }
            }


        //add cover if exists
            if ($cover = $request->file('cover')){
            if ($product->cover){
                list($name,$ext)=explode('.',$product->cover);
                $deletedImages =[
                    'public/product/'.$product->cover,
                    'public/product/'.$name .'@'. 400 . '.'.$ext,
                    'public/product/'.$name .'@'. 550 . '.'.$ext,
                    'public/product/'.$name .'@'. 750 . '.'.$ext,
                    'public/product/'.$name .'@'. 1024 . '.'.$ext,
                ];

                Storage::delete($deletedImages);
            }

            //store image and return the full path of it
            $fullImageUrl=Storage::putFile('public/product', $cover);

            //create instance of image file
            $imageFile= new File(storage_path('app/'.$fullImageUrl));

            //make different resolution for different screen size
            $this->makeResize($imageFile,400);
            $this->makeResize($imageFile,550);
            $this->makeResize($imageFile,750);
            $this->makeResize($imageFile,1024);

            $coverImg= explode('/',$fullImageUrl);
            $product->cover = last($coverImg);

        }



            if ($images=$request->file('extraImages')){
            $product->extra_images=explode(',',$product->extra_images);
            $arr_images=is_array($product->extra_images)?$product->extra_images : [];
            for ($i=0,$c=count($images);$i<$c;$i++){

                //store image and return the full path of it

                $fullImageUrl=Storage::putFile('public/extra_images',$images[$i]);
                //create instance of image file

                $imageFile= new File(storage_path('app/'.$fullImageUrl));

                //make different resolution for different screen size
                $this->makeResize($imageFile,400,'extra_images');

                $img= explode('/', $fullImageUrl);

                $arr_images[]=last($img);
            }

            $product->extra_images= ($arr_images)? implode(',',array_filter($arr_images)): null;
        }
        //add slug
            $product->slug= $request['product_slug'];

            if($product->update()){

            if ($images= $request->file('image')){
                for ($i = 0; $i < count($images); $i++) {
                    $img = new Image();
                    //store image and return the full path of it
                    $fullImageUrl=Storage::putFile('public/product', $images[$i]);
                    $productImg= explode('/',$fullImageUrl);
                    $img->image_url = last($productImg);
                    $product->images()->save($img);
                    if ($img->image_url){
                        //create instance of image file
                        $imageFile= new File(storage_path('app/'.$fullImageUrl));
                        //make different resolution for different screen size
                        $this->makeResize($imageFile,400);
                        $this->makeResize($imageFile,550);
                        $this->makeResize($imageFile,750);
                        $this->makeResize($imageFile,1024);
                    }
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
        //if product has extra images catch them in deleted array
        if ($images=$product->extra_images){
            $images=explode(',',$images);
            foreach ($images as $image){
                list($name,$ext)= explode('.',$image);
                $deleted= array_merge($deleted,
                    [
                    'public/extra_images/'.$image,
                    'public/extra_images/'.$name . '@' . 400 .'.' .$ext

                ]);
            }
        }
        //if product has images catch them in deleted array
        foreach ($product->images->toArray() as $image){
            list($name,$ext)= explode('.',$image['image_url']);
            $deleted=array_merge($deleted,
                [
                    'public/product/'.$image['image_url'],
                    'public/product/'.$name . '@'. 400 .'.'.$ext,
                    'public/product/'.$name . '@'. 550 .'.'.$ext,
                    'public/product/'.$name . '@'. 750 .'.'.$ext,
                    'public/product/'.$name . '@'. 1024 .'.'.$ext,
                ]);
        }

        // catch product cover in deleted array
        list($name,$ext)= explode('.',$product->cover);

        $deleted=array_merge($deleted,
            [
                'public/product/'.$product->cover,
                'public/product/'.$name . '@'. 400 .'.'.$ext,
                'public/product/'.$name . '@'. 550 .'.'.$ext,
                'public/product/'.$name . '@'. 750 .'.'.$ext,
                'public/product/'.$name . '@'. 1024 .'.'.$ext,
            ]);
            //delete all images in deleted array
        Storage::delete($deleted);

        return ($product->delete())?  redirect()->back()->with(['success'=>'product deleted successfully'])
            : redirect()->back()->with(['failed'=>'Try again, the process failed']);
    }

    /** Prepare data of product
     * @param Product $product
     * @return array
     */
    private function prepareProduct(Product $product){

        $data= $product->toArray();
        //get the extra images
        $data['extra_imagesResolution']=[];
        $data['imagesResolution']=[];
       if ($data['extra_images']){
           $arr=explode(',',$data['extra_images']);
           foreach ($arr as $item){
               list($name,$ext)=explode('.',$item);
               $data['extra_imagesResolution'][]=[
                   'larger'=> asset('storage/extra_images/'.$item),
                   '400'=> asset('storage/extra_images/'.$name . '@' . 400 .'.'.$ext),
               ];
           }
       }

       //get the cover images
       list($name,$ext)= explode('.',$data['cover']);

        $data['cover']= [
           'larger'=> asset("storage/product/" .$data['cover']),
           '400'=>asset("storage/product/" . $name . '@' . 400 .'.' .$ext),
           '550'=>asset("storage/product/" . $name . '@' . 550 .'.' .$ext),
           '750'=>asset("storage/product/" . $name . '@' . 750 .'.' .$ext),
           '1024'=>asset("storage/product/" . $name . '@' . 1024 .'.' .$ext),
        ];


        //get the product images

       foreach ($product->images->toArray() as $item){
           list($name,$ext)= explode('.',$item['image_url']);
           $data['imagesResolution'][]=[
               'larger'=>asset('storage/product/'.$item['image_url']),
               '400'=>  asset('storage/product/'.$name . '@' . 400 .'.' .$ext),
               '550'=>  asset('storage/product/'.$name . '@' . 550 .'.' .$ext),
               '750'=>  asset('storage/product/'.$name . '@' . 750 .'.' .$ext),
               '1024'=> asset('storage/product/'.$name . '@' . 1024 .'.'.$ext),
           ];
       }


       $data['images']=$product->images->toArray();

        return $data;
    }

    private function makeResize(File $fileImage,$width,$folder='product',$height=null,$quality=80){
        list($name, $extension)= explode('.',$fileImage->getFilename());
        $img=ImageResize::make($fileImage->getRealPath());

        $img->resize($width,$height,function ($constrains){
            $constrains->aspectRatio();

        });
        $img->save(storage_path('app/public/'.$folder.'/'.$name ."@".$width .'.'.$extension),$quality);
    }

    public function products(){
        $products = Product::inRandomOrder()->paginate(6);
        if ($products->count()== 0) return redirect()->route('products.all');
        foreach ($products as $product){
            list($name,$ext)=explode('.',$product->cover);
            $product->cover=[
                'larger'=>asset('storage/product/'.$product->cover),
                '400'=>  asset('storage/product/'.$name . '@' . 400 .'.' .$ext),
                '550'=>  asset('storage/product/'.$name . '@' . 550 .'.' .$ext),
                '750'=>  asset('storage/product/'.$name . '@' . 750 .'.' .$ext),
                '1024'=> asset('storage/product/'.$name . '@' . 1024 .'.'.$ext),
            ];
        }
        $settings = (new  SettingController())->prepareAllSettings();
        return view('blog.pages.all-products',compact('settings','products'));
    }
}
