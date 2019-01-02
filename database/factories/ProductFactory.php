<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title'=>$faker->text(15),
        'description'=>$faker->text(40),
        'cover'=>'https://via.placeholder.com/1000x300',
        'category_id'=>function(){
        return factory(\App\Category::class)->create()->id;
        },
    ];
});
