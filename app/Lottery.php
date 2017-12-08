<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lottery extends Model
{
    protected $fillable = ['name'];

    public function winningTickets()
    {
        return $this->hasMany(WinningTicket::class);
    }

    public function addTickets($integer)
    {
        $this->winningTickets()->createMany(array_fill(0, $integer, []));
    }

    public function path($action = 'show')
    {
        return route("lottery.$action", $this);
    }
}
