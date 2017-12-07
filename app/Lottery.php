<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lottery extends Model
{
    protected $fillable = ['name'];

    public function path($action = 'show')
    {
        return route("lottery.$action", $this);
    }
}
