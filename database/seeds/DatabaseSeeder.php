<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
//        factory(\App\Product::class,5)->create()->each(function ( $e){
//            $e->images()->save(factory(\App\Image::class)->make());
//        });
        \App\User::create([
            'name' => 'osama',
            'email' => 'os.ns2013@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('osamanasr'),
        ]);
    }
}
