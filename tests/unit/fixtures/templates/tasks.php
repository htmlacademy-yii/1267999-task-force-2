<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

return [
    'category_id' => $faker->numberBetween(1, 8),
    'user_id' => $faker->numberBetween(1, 3),
    'city_id' => $faker->numberBetween(1, 500),
    'status' => $faker->numberBetween(1, 2),
    'name' => $faker->text(80),
    'details' => $faker->text(200),
    'budget' => $faker->numberBetween(0, 20000),
    'deadline' => $faker->dateTimeBetween('+1 week', '+2 week')->format("Y-m-d H:i:s"),
    'file_id' => $faker->numberBetween(0, 1000),
    'created_at' => $faker->dateTimeBetween('-3 day', '-1 day')->format("Y-m-d H:i:s"),
    'address' => $faker->secondaryAddress()
];
