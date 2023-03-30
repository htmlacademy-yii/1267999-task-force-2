<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

return [
    'city_id' => $faker->numberBetween(1, 500),
    'name' => $faker->name($gender = null),
    'email' => $faker->email(),
    'password' => $faker->password(),
    'rating' => $faker->numberBetween(1, 9),
    'created_at' => $faker->date(),
    'role' => $faker->numberBetween(0, 1000000),
    'birthday' => $faker->date(),
    'phone' => $faker->e164PhoneNumber(),
    'telegram' => $faker->phoneNumber(),
    'avatar_file_id' => $faker->numberBetween(1, 10000),
    'information' => $faker->text(500),
    'done_orders' => $faker->numberBetween(1, 500),
    'failed_orders' => $faker->numberBetween(1, 500),
    'place_rank' => $faker->numberBetween(1, 500)
];
