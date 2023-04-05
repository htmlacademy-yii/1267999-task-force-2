<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

return [
    'category_id' => $faker->numberBetween(1, 8),
    'user_id' => $faker->numberBetween(1, 3),
    'city_id' => $faker->numberBetween(1, 500),
    'status' => $faker->numberBetween(1, 5),
    'name' => $faker->text(80),
    'details' => $faker->text(200),
    'budget' => $faker->numberBetween(0, 20000),
    'deadline' => $faker->date(),
    'file_id' => $faker->numberBetween(0, 1000),
    'created_at' => $faker->date(),
    'address' => $faker->streetAddress()
];
