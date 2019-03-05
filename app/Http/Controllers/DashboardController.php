<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
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

            $categoryCount= \App\Category::all()->count();
            $productCount= \App\Product::all()->count();
            $imageCount= \App\Image::all()->count();
        return view('dashboard.pages.dashboard',compact("categoryCount","productCount","imageCount"));
    }
    public function logout(){


    }


}
