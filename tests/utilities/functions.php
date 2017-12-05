<?php

function create($class, $attributes = [])
{
    return factory($class)->create($attributes);
}

function createMany($class, $quantity, $attributes = [])
{
    return factory($class, $quantity)->create($attributes);
}

function make($class, $attributes = [])
{
    return factory($class)->make($attributes);
}

function makeMany($class, $quantity, $attributes = [])
{
    return factory($class, $quantity)->make($attributes);
}
