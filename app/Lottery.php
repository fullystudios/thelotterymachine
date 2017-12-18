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

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function freeTickets()
    {
        return $this->hasMany(WinningTicket::class)->whereNull('participant_id');
    }

    public function addTickets($integer)
    {
        $this->winningTickets()->createMany(array_fill(0, $integer, []));
    }

    public function addParticipant(array $participant)
    {
        $this->participants()->save(new Participant($participant));
    }

    public function path($action = 'show')
    {
        return route("lottery.$action", $this);
    }
}
