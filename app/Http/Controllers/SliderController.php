<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $image = explode('/',Storage::putFile('public/banners',$request->file('image')));
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

        if ($slider->image) Storage::delete('public/banners/'.$slider->image);

        return   $slider->delete() ?  redirect()->back()->with(['success'=>'Banner deleted successfully'])
            : redirect()->back()->with(['failed'=>'Try again, the process failed']);;
    }

    public function getSliderType(){
        $slider= Slider::where('type','slider')->get();
        return $slider;
    }
}
