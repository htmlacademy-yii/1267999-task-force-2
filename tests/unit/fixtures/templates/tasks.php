<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

return [
    'category_id' => $faker->numberBetween(1, 8),
    'customer_id' => $faker->numberBetween(1, 10),
    'city_id' => $faker->numberBetween(1, 500),
    'status' => $faker->numberBetween(1, 2),
    'name' => $faker->text(80),
    'details' => $faker->text(200),
    'budget' => $faker->numberBetween(0, 20000),
    'deadline' => $faker->dateTimeBetween('+1 week', '+2 week')->format("Y-m-d H:i:s"),
    'file_id' => $faker->numberBetween(0, 1000),
    'created_at' => $faker->dateTimeBetween('-2 day', '-5 minute')->format("Y-m-d H:i:s"),
    'address' => $faker->secondaryAddress(),
    'executor_id' => $faker->numberBetween(1, 10)
];
