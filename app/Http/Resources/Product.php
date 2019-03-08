<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */


    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
//            'desc'=>$this->description,
            'cover'=>asset('storage/product/'.$this->cover),
            'slug'=>$this->slug,
            'category_name'=>\App\Category::find($this->category_id)->name,
            'link' => route('products.show',$this->id),

        ];
    }




}
