<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //

    public function product(){
        return $this->belongsTo(Product::class);
    }

/*

    public function addNew(Product $product, $imageUrl){
        if(!$product){
            return redirect()->back()->with(['fail'=>'invalid operation']);
        }
        $state=false;
        if(is_array($imageUrl)){
            foreach ($imageUrl as $image){
                $img= new $this;
                $img->image_url= $image;
                $state = ($product->images()->save($img))?true:false;
            }
        }else{
                $img= new $this;
                $img->image_url= $imageUrl;
                $state = ($product->images()->save($img))?true:false;
        }
        return $state;
    }


public function delete($id){
        $image=Image::find($id);
        if(!$image) return redirect()->back()->with(['fail'=>'invalid operation']);
        return $image->delete();
}

public function allProjectImages(Product $product){
        return $product->images->toArray();
}

*/

}