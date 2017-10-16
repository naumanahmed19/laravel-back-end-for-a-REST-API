<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->company,
        'username' => $faker->username,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'mobile' => $faker->phoneNumber,
        'fax' => $faker->tollFreePhoneNumber,
        'verified' => true,
        'description' => $faker->text,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Profile::class, function (Faker\Generator $faker) use ($factory) {

    return [
        'user_id' => $factory->create(App\User::class)->id,
        'avatar' => $faker->imageUrl($width = 640, $height = 480),
        'address' => $faker->address,
        'phone1' => $faker->phoneNumber,
        'phone2' => $faker->phoneNumber,
        'mobile1' => $faker->phoneNumber,
        'mobile2' => $faker->phoneNumber,
        'fax' => $faker->tollFreePhoneNumber,
        'verified' => $faker->boolean,
        'description' => $faker->text,
    ];
});

$factory->define(App\Apartment::class, function (Faker\Generator $faker) use ($factory) {

    $userId = rand(1, 100);
    return [
        'user_id' => $userId,
        'title' => $faker->sentence,
        'slug' => $faker->slug,
        'content' => $faker->paragraph,
        'rent_type' => 'day',
        'rent' => $faker->numberBetween($min = 1000, $max = 9000),
        'tags' => $faker->word,
        'booked' => $faker->boolean,
        'city' => 'lahore',
        'active' => $faker->boolean,
    ];
});


//$factory->define(App\Inventory::class, function (Faker\Generator $faker) use($factory) {
//
//    return [
//        'user_id' => $factory->create(App\User::class)->id,
//        'name' => $faker->word,
//
//    ];
//});

//$factory->define(App\Order::class, function (Faker\Generator $faker) use($factory) {
//
//    return [
//        'user_id' => $factory->create(App\User::class)->id,
//        'apartment_id' => $factory->create(App\apartment::class)->id,
//        'quantity' => $faker->randomDigit,
//        'date_require' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
//        'status' => $faker->boolean,
//
//    ];
//});

$factory->define(App\Category::class, function (Faker\Generator $faker) use ($factory) {

    return [
        'parent_id' => $faker->word,
        'slug' => $faker->unique()->word,
        'description' => $faker->text,

    ];
});




//
//$factory->define(function (Faker\Generator $faker) use($factory) {
//
//    return [
//        'apartment_id' =>  $factory->create(App\apartment::class)->id,
//        'inventory_id' =>  $factory->create(App\Inventory::class)->id,
//
//    ];
//});
