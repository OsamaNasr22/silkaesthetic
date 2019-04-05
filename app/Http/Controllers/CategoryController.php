<?php

namespace App\Http\Controllers;

use App\Category;
use App\Option;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\File;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('show','CategoryProducts');
    }

    /**
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $categores=(new Category())->allCategories();
        return view('dashboard.pages.allCat',['categories'=>$categores]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.pages.addNewCat');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       // dd($request->all());
        $this->validate($request, [
            'category_name' => 'required|string',
            'cover'  =>'required|image|mimes:jpeg,jpg,png,gif|max:15000',
            'slide'  =>'required|image|mimes:jpeg,jpg,png,gif|max:15000',
            'titles.*'=>'nullable|string',
            'desc.*'=>'nullable|string',
            'optionImages.*'=>'image|mimes:jpeg,jpg,png|max:1024',
        ]);
//        dd($request->all());
        $category = new Category();
        $category->name= $request['category_name'];
        // upload cover
        if ($image=$request->file('cover')){

            //store image and return the full path of it
            $fullImageUrl=Storage::putFile('public/product',$image);

            //create instance of image file
//            $imageFile= new File(storage_path('app/'.$fullImageUrl));
//
//            //make different resolution for different screen size
//            $this->makeResize($imageFile,400);
//            $this->makeResize($imageFile,550);
//            $this->makeResize($imageFile,750);
//            $this->makeResize($imageFile,1024);


            $image = explode('/',$fullImageUrl);
            $category->cover= last($image); // get the image name without the full path
        }

        //upload slide image
        if ($image=$request->file('slide')){

            //store image and return the full path of it
            $fullImageUrl=Storage::putFile('public/product',$image);

            //create instance of image file
//            $imageFile= new File(storage_path('app/'.$fullImageUrl));
//
//            //make different resolution for different screen size
//            $this->makeResize($imageFile,400);
//            $this->makeResize($imageFile,550);
//            $this->makeResize($imageFile,750);
//            $this->makeResize($imageFile,1024);
            $image = explode('/',$fullImageUrl);
            $category->slide= last($image); // get the image name without the full path
        }
        $category->save();//save the category


        $images= $request->file('optionImages');
        if ($request['titles']){
            foreach ($request['titles'] as $i => $value)
            {
                $option = new Option();
                $option->key= $value;
                $option->value= htmlspecialchars($request['desc'][$i]);
                if ($images){
                    if ($image = $images[$i]){
                        $image = explode('/',Storage::putFile('public/extra_images',$image));
                        $option->image= last($image);
                    }
                }
                $category->options()->save($option);
            }
        }
        return redirect()->back()->with(['success'=>'Category added successfully']);


}
    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

            $category= $this->prepareCategory($category);
//        dd($category);
        $settings = (new  SettingController())->prepareAllSettings();

        return view('blog.pages.category',compact('category','settings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $options=$category->options;
        return view('dashboard.pages.editCat',['category'=>$category->toArray() ,'options'=>$options]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
//        //
//        $this->validate($request ,[
//            'category_name'=>'required|alpha'
//        ]);
//        if($category->updateCat($category,$request['category_name'])){
//
//            return redirect()->back()->with(['success'=>'category updated successfully']);
//        }
//        return redirect()->back()->with(['fail'=>'invalid operation'
//        ]);
        $this->validate($request, [
            'category_name' => 'required|string',
            'cover'  =>'nullable|image|mimes:jpeg,jpg,png,gif|max:15000',
            'slide'  =>'nullable|image|mimes:jpeg,jpg,png,gif|max:15000',
            'titles.*'=>'nullable|string',
            'desc.*'=>'nullable|string',
            'optionImages.*'=>'nullable|image|mimes:jpeg,jpg,png|max:1024',
            'editTitles.*'=>'nullable|string',
            'editDesc.*'=>'nullable|string',
            'editImage.*'=>'nullable|image|mimes:jpeg,jpg,png|max:1024',
        ]);


        $category->name= $request['category_name'];
        if ($image=$request->file('cover')){
            //delete old cover
            if ($category->cover)
            {
//                list($name, $ext)= explode('.',$category->cover);
//                // prepare all cover images for deleted
//                $deletedImages= [
//                    'public/product/'.$category->cover,
//                    'public/product/'.$name . '@'. '400' . '.'.$ext,
//                    'public/product/'.$name . '@'. '550' . '.'.$ext,
//                    'public/product/'.$name . '@'. '750' . '.'.$ext,
//                    'public/product/'.$name . '@'. '1024' . '.'.$ext,
//
//                ];
                Storage::delete($category->cover);
            }

            //store image and return the full path of it
            $fullImageUrl=Storage::putFile('public/product',$image);

//            //create instance of image file
//            $imageFile= new File(storage_path('app/'.$fullImageUrl));
//
//            //make different resolution for different screen size
//            $this->makeResize($imageFile,400);
//            $this->makeResize($imageFile,550);
//            $this->makeResize($imageFile,750);
//            $this->makeResize($imageFile,1024);


            //add new one
            $image = explode('/',$fullImageUrl);
            $category->cover= last($image);
        }

        if ($image=$request->file('slide')){
            //delete old slide
            if ($category->slide)
            {
//                list($name, $ext)= explode('.',$category->slide);
//                // prepare all cover images for deleted
//                $deletedImages= [
//                    'public/product/'.$category->slide,
//                    'public/product/'.$name . '@'. '400' . '.'.$ext,
//                    'public/product/'.$name . '@'. '550' . '.'.$ext,
//                    'public/product/'.$name . '@'. '750' . '.'.$ext,
//                    'public/product/'.$name . '@'. '1024' . '.'.$ext,
//
//                ];
                Storage::delete($category->slide);
            }

            //store image and return the full path of it
            $fullImageUrl=Storage::putFile('public/product',$image);

//            //create instance of image file
//            $imageFile= new File(storage_path('app/'.$fullImageUrl));
//
//            //make different resolution for different screen size
//            $this->makeResize($imageFile,400);
//            $this->makeResize($imageFile,550);
//            $this->makeResize($imageFile,750);
//            $this->makeResize($imageFile,1024);


            //add new one
            $image = explode('/',$fullImageUrl);
            $category->slide= last($image);
        }
        $category->update();

        //deleteOptions
        if (strlen($request['deletedOption']) > 0){
            $ids =explode(',',$request['deletedOption']);
            foreach ($ids as $id){
                $option= Option::find($id);
                if ($option) $option->delete();
            }
        }


        if ($request['editTitles']){
            $images=$request->file('editImage');

            foreach ($request['editTitles'] as $i => $value) {
                $option= Option::find($i);
                $option->key= $value;
                $option->value=htmlspecialchars($request['editDesc'][$i]);
                if (isset($images[$i])){
                    $image=$images[$i];
                    if ($option->image) Storage::delete('public/extra_images/'.$option->image);
                    $image = explode('/',Storage::putFile('public/extra_images',$image));
                    $option->image= last($image);
                }
                $option->update();
            }
        }


        if ($request['titles']){
            $images= $request->file('optionImages');
            foreach ($request['titles'] as $i => $value)
           {
                $option = new Option();
                $option->key= $value;
                $option->value= htmlspecialchars($request['desc'][$i]);
                if (isset($images[$i])){
                    if ($image = $images[$i]){
                        $image = explode('/',Storage::putFile('public/extra_images',$image));
                        $option->image= last($image);
                    }
                }
                $category->options()->save($option);
            }

        }

        return redirect()->back()->with(['success'=>'Category updated successfully']);






    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
//        $category =Category::find($id);
//        if (!$category) return response()->json('failed',404);

        if ($category->products->toArray()){
            foreach ($category->products as $product){
                (new ProductController())->destroy($product);
            }
        }
        foreach ($category->options->toArray() as $item){
            if ($item['image']) Storage::delete('public/extra_images/'.$item['image']);
        }

        //delete category cover
        if($category->cover)
        {
//            list($name, $ext)= explode('.',$category->cover);
//
//            // prepare all cover images for deleted
//            $deletedImages= [
//                'public/product/'.$category->cover,
//                'public/product/'.$name . '@'. '400' . '.'.$ext,
//                'public/product/'.$name . '@'. '550' . '.'.$ext,
//                'public/product/'.$name . '@'. '750' . '.'.$ext,
//                'public/product/'.$name . '@'. '1024' . '.'.$ext,
//
//            ];
            Storage::delete($category->cover);
        }

        //delete category cover
        if($category->slide)
        {
//            list($name, $ext)= explode('.',$category->slide);
//
//            // prepare all cover images for deleted
//            $deletedImages= [
//                'public/product/'.$category->slide,
//                'public/product/'.$name . '@'. '400' . '.'.$ext,
//                'public/product/'.$name . '@'. '550' . '.'.$ext,
//                'public/product/'.$name . '@'. '750' . '.'.$ext,
//                'public/product/'.$name . '@'. '1024' . '.'.$ext,
//
//            ];
            Storage::delete($category->slide);
        }
        return ($category->delete())? redirect()->back()->with(['success'=>'category deleted successfully'])
            : redirect()->back()->with(['failed'=>'Try again, the process failed']);
    }

    public function CategoryProducts(Category $category){

        if ( ! $category->products->toArray()) return redirect()->back();
        $products = Product::inRandomOrder()->paginate(6);
        if ($products->count()== 0) return redirect()->back();

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

        return view('blog.pages.products',compact('category','settings','products'));
    }


    private function makeResize(File $fileImage,$width,$height=null,$quality=80){
        list($name, $extension)= explode('.',$fileImage->getFilename());
        $img=Image::make($fileImage->getRealPath());

        $img->resize($width,$height,function ($constrains){
            $constrains->aspectRatio();

        });
        $img->save(storage_path('app/public/product/'.$name ."@".$width .'.'.$extension),$quality);
    }
    public function prepareCategory(Category $category){
        $options=$category->options->toArray();
        $category->options=$options;
//        if ($category->cover){
//            list($name,$ext)=explode('.',$category->cover);
//            $category->coverResolutions= [
//                '400'=> $name . '@' . 400 .'.'.$ext,
//                '550'=>$name . '@' . 550 .'.'.$ext,
//                '750'=>$name . '@' . 750 .'.'.$ext,
//                '1024'=>$name . '@' . 1024 .'.'.$ext,
//            ];
//        }
//
//        if ($category->slide){
//            list($name,$ext)=explode('.',$category->slide);
//            $category->slideResolutions= [
//                '400'=> $name . '@' . 400 .'.'.$ext,
//                '550'=>$name . '@' . 550 .'.'.$ext,
//                '750'=>$name . '@' . 750 .'.'.$ext,
//                '1024'=>$name . '@' . 1024 .'.'.$ext,
//            ];
//        }
        return $category;
    }
}
