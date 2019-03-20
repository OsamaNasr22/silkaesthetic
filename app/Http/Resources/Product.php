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
        list($name,$ext)=explode('.',$this->cover);
        return [
            'id'=>$this->id,
            'title'=>$this->title,
//            'desc'=>$this->description,
            'cover'=>['larger'=>asset('storage/product/'.$this->cover),
            '400'=>asset('storage/product/'.$name . '@' . 400 .'.'.$ext),
            '550'=>asset('storage/product/'.$name . '@' . 550 .'.'.$ext),
            '750'=>asset('storage/product/'.$name . '@' . 750 .'.'.$ext),
            '1024'=>asset('storage/product/'.$name . '@' . 1024 .'.'.$ext),
            ],
            'slug'=>$this->slug,
            'category_name'=>\App\Category::find($this->category_id)->name,
            'link' => route('products.show',$this->id),

        ];
    }




}
