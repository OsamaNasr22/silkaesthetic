<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\ProductCollection;
use App\Mail\SendMessage;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BlogController extends Controller
{
    //


    public function __invoke()
    {
        // TODO: Implement __invoke() method.

        foreach ($categories=Category::all() as $item){
        $item = (new CategoryController())->prepareCategory($item);
        }
        $settings = (new  SettingController())->prepareAllSettings();
        $sliders =(new SliderController())->getSliderType();
//        dd($sliders);
        return view('blog.pages.home',compact('categories','settings','sliders'));
    }
    public function categories(){
        return new CategoryCollection(Category::all());
    }

/*    public function allProducts(){
        return new ProductCollection(Product::paginate(3));
    }*/

    public function test(){
        $data= [
            'name'=>'name',
            'phone'=>"01229194145",
            'sender'=>'os.ns@gmail.com',
            'message'=>'ksdnk',
        ];

        Mail::to('info@silkaesthetic.com')->send(new  SendMessage($data));
    }

    public function productsByCategory($category_id){
        $products= Category::find($category_id)->products()->paginate(6);
        header("Access-Control-Allow-Origin: *");
        return new ProductCollection($products);
    }

    public function allProducts(){
        $products = Product::inRandomOrder()->paginate(6);
        header("Access-Control-Allow-Origin: *");
        return new ProductCollection($products);
    }
}
