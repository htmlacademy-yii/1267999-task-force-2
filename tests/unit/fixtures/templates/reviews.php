<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

return [
    'task_id' => $faker->numberBetween(0, 100),
    'customer_id' => $faker->numberBetween(0, 100),
    'created_at' => $faker->date(),
    'executor_id' => $faker->numberBetween(0, 100),
    'rating' => $faker->numberBetween(0, 10),
    'comment' => $faker->text(300)
];
