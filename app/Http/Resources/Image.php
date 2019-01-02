<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Image extends JsonResource
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
            'image_url'=> $this->imageUrl($this->image_url)
        ];

    }
    private function imageUrl($imageUrl){

            $img= explode('\\',$imageUrl);
            $img= asset("storage/" .end($img)) ;
            return $img;

    }
}
