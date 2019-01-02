<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      return [
         'data'=>Product::collection($this->collection)
       ];
    }
    public function with($request)
    {
        $category_name= $this->collection->map(function ($pro){
            return \App\Category::find($pro->category_id)->name;
        });
        return [
            'category_name'=>$category_name
        ];
    }
}
