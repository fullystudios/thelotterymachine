<?php

use App\Ticket;
use App\Lottery;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    return [
        'lottery_id' => function () {
            return create(Lottery::class);
        }
    ];
});
