<?php

namespace App\Http\Controllers;

use App\Category;
use App\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'cover'  =>'required|image|mimes:jpeg,jpg,png|max:15000',
            'titles.*'=>'nullable|string',
            'desc.*'=>'nullable|string',
            'optionImages.*'=>'image|mimes:jpeg,jpg,png|max:1024',
        ]);
//        dd($request->all());
        $category = new Category();
        $category->name= $request['category_name'];
        if ($image=$request->file('cover')){
            $image = explode('/',Storage::putFile('public/product',$image));
            $category->cover= last($image);
        }
        $category->save();
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
        }else{$category->save();}
        return redirect()->back()->with(['success'=>'Category added successfully']);




//
//        return (new Category())->addCategory($request['category_name']);
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $options=$category->options->toArray();
        $category->options=$options;
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
            'cover'  =>'nullable|image|mimes:jpeg,jpg,png|max:15000',
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
            Storage::delete('public/product/'.$category->cover);

            //add new one
            $image = explode('/',Storage::putFile('public/product',$image));
            $category->cover= last($image);
        }
        $category->update();


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

        }else{$category->save();}

        return redirect()->back()->with(['success'=>'Category added successfully']);






    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $category =Category::find($id);
        if (!$category) return response()->json('failed',404);

        if ($category->products->toArray()){
            foreach ($category->products as $product){
                (new ProductController())->destroy($product->id);
            }
        }

        foreach ($category->options->toArray() as $item){
            if ($item['image']) Storage::delete('public/extra_images/'.$item['image']);
        }
        if($category->cover) Storage::delete('public/product/'.$category->cover);
        return ($category->delete())? response()->json('category deleted successfully',200): response()->json('faild in delete category',400);
    }
    public function CategoryProducts(Category $category){

        if ( ! $category->products->toArray()) return redirect()->back();
            $category= $category->toArray();
        $settings = (new  SettingController())->prepareAllSettings();

        return view('blog.pages.products',compact('category','settings'));
    }
}
