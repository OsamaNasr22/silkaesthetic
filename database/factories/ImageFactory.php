<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
    return [
        //

        'image_url'=>'https://via.placeholder.com/300x300',
        'product_id'=>function(){
        return factory(\App\Product::class)->create()->id;
        }
    ];
});
