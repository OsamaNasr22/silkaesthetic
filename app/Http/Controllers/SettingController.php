<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class SettingController
 * @package App\Http\Controllers
 */
class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $settings= Setting::find(1);
        $settings->extra_options= $this->returnOptions( $settings->extra_options);

        if (! $settings){
            $settings = new Setting();
            $settings->save();
        }
        return view('dashboard.pages.settings',compact('settings'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {



        $this->validate($request,[
           'site_name'=>'required|max:191|string',
           'logo'=>'image|mimes:jpeg,png,jpg|max:15360',
            'email'=>'required|email',
            'facebook'=>'nullable|url|max:191',
            'twitter'=>'nullable|url|max:191',
            'insta'=>'nullable|url|max:191',
            'linkedin'=>'nullable|url|max:191',
            'title.*'=>'nullable|alpha_dash',
            'desc.*'=>'nullable|string',
            'about_us'=>'required|string|max:16000000'
        ]);
        $setting->name= $request['site_name'];
        if ($image=$request->file('logo')){
            if ($setting->logo) Storage::delete('public/extra_images/'.$setting->logo);
            $image= explode('/' ,Storage::putFile('public\extra_images', $image));
            $setting->logo = last($image);
        }
        $setting->email=$request['email'];
        $setting->about_us=$request['about_us'];
        $setting->facebook= $request['facebook'];
        $setting->twitter= $request['twitter'];
        $setting->linkedin= $request['linkedin'];
        $setting->insta= $request['insta'];
        $setting->extra_options= $this->prepareOptions($request['titles'],$request['desc']);
        return ($setting->update())?
            redirect()->back()->with(['success' => 'Settings updated successfully']):
            redirect()->back()->with(['fail' => 'failed in update settings try again']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }

    /**
     * @param $arr1
     * @param $arr2
     * @return string
     */
    private function prepareOptions($arr1, $arr2){
        $str='';
        for ($i=0,$c=count($arr1);$i<$c;$i++){
            $str.= "{$arr1[$i]}@#@#{$arr2[$i]}*&^";
        }

        $str= rtrim($str,'*&^');
        return $str;
    }

    /**
     * @param $str
     * @return array
     */
    private function returnOptions($str){
        $arr2=[];
        $arr= explode('*&^',$str);
        if (!$arr) return [];
        for ($i=0, $c= count($arr);$i<$c;$i++){
            $test= explode('@#@#',$arr[$i]);
            if(count($test)!= 2) return $arr2;
            $arr2[$test[0]]=$test[1];
        }
        return $arr2;
    }

    /**
     * @return array|mixed
     */
    public function prepareAllSettings(){
        $settings= Setting::all()->first();
        if (! $settings->toArray()) return [];
        $settings->extra_options=$this->returnOptions($settings->extra_options);
        return $settings;
   }
}
