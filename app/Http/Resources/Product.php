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
            'desc'=>$this->description,
            'cover'=>$this->cover($this->cover),
            'category_id'=>$this->category_id,
            'link' => route('products.show',$this->id)
        ];
    }


    private function cover($cover){

        $img= explode('\\',$cover);
        $cover= asset("storage/" .end($img));
        return $cover;
    }

}
