<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WinningTicket extends Model
{
    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }

    public function setWinner(User $winner)
    {
        $this->winner()->associate($winner);
    }
}
