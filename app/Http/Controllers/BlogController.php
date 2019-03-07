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
        $categories= Category::all();

        return view('blog.pages.home',compact('categories'));
    }

    public function categories(){
        return new CategoryCollection(Category::all());
    }

    public function allProducts(){
        return new ProductCollection(Product::paginate(3));
    }

    public function test(){
        $data= [
            'name'=>'name',
            'phone'=>"01229194145",
            'sender'=>'os.ns@gmail.com',
            'message'=>'ksdnk',
        ];

        Mail::to('os.ns2013@gmail.com')->send(new  SendMessage($data));
    }

    public function productsByCategory($category_id){
        $products= Category::find($category_id)->products()->paginate(3);
        return new ProductCollection($products);
    }
}
