<?php

use App\Lottery;
use Faker\Generator as Faker;

$factory->define(Lottery::class, function (Faker $faker) {
    return [
        'name' => 'The Laravel Lottery'
    ];
});
