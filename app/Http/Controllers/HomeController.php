<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
$file=new File(storage_path('app/public/banners/V591eq3bPKZ9NbVsXJoPeCGAMcmKWjjKuyLEl0hH.jpeg'));
list($name, $extension)= explode('.',$file->getFilename());

echo $name;
        $img= Image::make($file->getRealPath());
        $img->resize(400,null,function ($constrains){
            $constrains->aspectRatio();
            $constrains->upsize();
        });
        $img->save(storage_path('app/public/banners/' . $name . 400 .'.'. $extension),20);
        $img2= Image::make($file->getRealPath());

        $img2->resize(500,null,function ($constrains){
            $constrains->aspectRatio();
            $constrains->upsize();
        });
        $img2->save(storage_path('app/public/banners/' . $name . 500 .'.'. $extension),20);

        print_r($img);
        print_r(get_loaded_extensions());
//        $categories= Category::all();
//        dd($categories);
//        return view('blog.pages.home',compact('categories'));
    }


}
