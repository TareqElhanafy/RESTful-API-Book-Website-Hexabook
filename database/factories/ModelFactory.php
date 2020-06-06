<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\Category;
use App\Freebook;
use App\Paidbook;
use App\Seller;
use App\User;
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' =>'password',
        'verified'=>$faker->randomElement(['1','0']),
        'role'=>$faker->randomElement(['true','false']),
        'verification_token'=>User::generateVerificationToken(),
        'remember_token' => str_random(10),

    ];
});

$factory->define(App\Freebook::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word(),
        'writer_name' => $faker->name,
        'description' =>$faker->paragraph(),
        'image'=>$faker->randomElement(['1.jpg','2.jpg','3.jpg']),
        'available'=>$faker->randomElement(['1','0']),
        'category_id'=>Category::all()->random()->id,
        'user_id'=>User::all()->random()->id,
    ];
});


$factory->define(App\Paidbook::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word(),
        'writer_name' => $faker->name,
        'description' =>$faker->paragraph(4),
        'image'=>$faker->randomElement(['1.jpg','2.jpg','3.jpg']),
        'available'=>$faker->randomElement(['1','0']),
        'seller_id'=>User::all()->random()->id,
        'price'=>$faker->numberBetween(220,500),
        'quantity'=>$faker->numberBetween(1,10),
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word(),
        'description' =>$faker->paragraph(),
    ];
});

$factory->define(App\Discussion::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->word(),
        'content' =>$faker->paragraph(7),
        'freebook_id'=>Freebook::all()->random()->id,
    ];
});
$factory->define(App\Transaction::class, function (Faker\Generator $faker) {
$seller=Seller::has('paidbooks')->get()->random();
$buyer=User::all()->except($seller->id)->random();
    return [
        'buyer_id' => $buyer->id,
        'quantity' =>$faker->numberBetween(1,5),
        'paidbook_id'=>$seller->paidbooks->random()->id,
    ];
});