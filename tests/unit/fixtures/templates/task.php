<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

return [
    'category_id' => $faker->numberBetween(1, 8),
    'user_id' => $faker->numberBetween(1, 3),
    'city_id' => $faker->numberBetween(1, 500),
    'coordinates' => $faker->numberBetween(1, 5),
    'status' => $faker->numberBetween(1, 5),
    'name' => $faker->numberBetween(0, 10),
    'details' => $faker->numberBetween(0, 10),
    'budget' => $faker->numberBetween(0, 10),
    'deadline' => $faker->numberBetween(0, 10),
    'files_id' => $faker->numberBetween(0, 10),
    'created_at' => $faker->numberBetween(0, 10),
    'adress' => $faker->text(300)
];
