<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function images(){
        return $this->hasMany(Image::class);


    }

/*
    public function addNew(array $data){
        if(is_null($data) || !is_array($data)){
            return redirect()->back()->with([
                'fail'=>'invalid operation'
            ]);
        }
        $product= new $this;
        foreach ($data as $key => $datum) {
            $product->$key=$datum;
        }
        return ($product->save())?redirect()->back()->with(['success'=>'product added successfully']): redirect()->back()->with(
            [
                'fail'=>'Please try again add operation failed'
            ]
        );


    }
    public function updateProduct(Product $product ,array $data){


        if(is_null($data) || !is_array($data)){

            return redirect()->back()->with([
                'fail'=>'invalid operation'
            ]);

        }

        foreach ($data as $key => $datum) {
            $product->$key=$datum;
        }
        return ($product->update())?redirect()->back()->with(['success'=>'product updated successfully']): redirect()->back()->with(
            [
                'fail'=>'Please try again update operation failed'
            ]
        );
    }
    public function deleteProduct(Product $product){
        return ($product->delete())?redirect()->back()->with(['success'=>'product deleted successfully']):redirect()->back()->with(['fail'=>'Please try again delete operation failed']);
    }
    public function getProduct(Product $product){
        return $product->toArray();
    }
    public function allProduct(){
        return static::all()->toArray();
    }

*/
}
