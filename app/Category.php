<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function options(){
        return $this->hasMany(Option::class);
    }

   public function products(){
       return $this->hasMany(Product::class);
   }

   public function addCategory($name){

       if(is_null($name)){
           return redirect()->back()->with(['fail'=>'invalid operation']);
       }
       $cat = new $this;
      $cat->name= $name;
       return ($cat->save())?redirect()->back()->with(['success'=>'category added successfully']): redirect()->back()->with(
           [
               'fail'=>'Please try again add operation failed'
           ]
       );
   }
   public function updateCat(Category $category, $name){
       if(is_null($name) ){
           return redirect()->back()->with(['fail'=>'invalid operation']);
       }

       $category->name= $name;
       return $category->update();
   }
   public function getCategory(Category $category){
       return $category->toArray();
   }
   public function allCategories(){
       return static::all()->toArray();
   }
}
