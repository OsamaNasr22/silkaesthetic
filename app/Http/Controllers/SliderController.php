<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sliders= Slider::all()->toArray();
        return  view('dashboard.pages.sliders',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.pages.addSlider');
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
        $this->validate($request,[
            'image'=>'required|image|mimes:jpeg,jpg,png,gif|max:1024',
            'type'=>'required|string'
        ]);

        $fullImagePath=Storage::putFile('public/banners',$request->file('image'));
        //create 4 images for different screen size

      /*  if ($request['type']=='slider'){
            $fileImage= new File(storage_path('app/'.$fullImagePath));
            $this->makeResize($fileImage,400);
            $this->makeResize($fileImage,550);
            $this->makeResize($fileImage,750);
            $this->makeResize($fileImage,1024);
        }*/

        $image = explode('/',$fullImagePath);
        $slider = new Slider();
        $slider->image= last($image);
        $slider->type=$request['type'];
        $slider->save();
        return redirect()->back()->with(['success'=>'Banner add successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    public function destroy(Slider $slider)
    {

        if ($sliderImage=$slider->image  ){

            Storage::delete('public/banners/'.$slider->image);
            /*if ($slider->type =='slider'){
                list($name,$extension)= explode('.',$sliderImage);
                //deleted the different resolution images
                $deleted=[
                    'public/banners/'.$name . '@'. 400 . ".".$extension,
                    'public/banners/'.$name . '@'. 550 . ".".$extension,
                    'public/banners/'.$name . '@'. 750 . ".".$extension,
                    'public/banners/'.$name . '@'. 1024 . ".".$extension,
                ];
                Storage::delete($deleted);
            }*/
        };
        return   $slider->delete() ?  redirect()->back()->with(['success'=>'Banner deleted successfully'])
            : redirect()->back()->with(['failed'=>'Try again, the process failed']);
    }

    public function getSliderType($type){
        $slider= Slider::where('type',$type)->get();
      /*  foreach ($slider as $item){
           list($name,$ext)=explode('.',$item->image);
           $item->imageResoulutions=[
            '400'=> $name . '@' . 400 .'.'.$ext,
             '550'=>$name . '@' . 550 .'.'.$ext,
             '750'=>$name . '@' . 750 .'.'.$ext,
             '1024'=>$name . '@' . 1024 .'.'.$ext,
           ];
        }*/

        return $slider;
    }
    private function makeResize(File $fileImage,$width,$height=null,$quality=80){
        list($name, $extension)= explode('.',$fileImage->getFilename());
        $img=Image::make($fileImage->getRealPath());

        $img->resize($width,$height,function ($constrains){
            $constrains->aspectRatio();

        });
        $img->save(storage_path('app/public/banners/'.$name ."@".$width .'.'.$extension),$quality);
    }
}
