<?php

use App\Lottery;
use App\WinningTicket;
use Faker\Generator as Faker;

$factory->define(WinningTicket::class, function (Faker $faker) {
    return [
        'lottery_id' => function () {
            return create(Lottery::class);
        }
    ];
});
