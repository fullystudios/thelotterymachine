<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\NotEnoughTicketsException;
use App\Exceptions\NotEnoughParticipantsException;

class Lottery extends Model
{
    protected $fillable = ['name', 'creator_id'];

    public static function boot()
    {
        parent::boot();
        self::saving(function ($model) {
            $model->share_key = str_random(20);
        });
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function winners()
    {
        return $this->hasMany(Participant::class)->whereHas('ticket');
    }

    public function nonWinners()
    {
        return $this->hasMany(Participant::class)->whereDoesntHave('ticket');
    }

    public function availableTickets()
    {
        return $this->hasMany(Ticket::class)->whereNull('participant_id');
    }

    public function addTickets($integer)
    {
        $this->tickets()->createMany(array_fill(0, $integer, []));
        return $this;
    }

    public function addParticipant(array $participant)
    {
        $this->participants()->save(new Participant($participant));
        return $this;
    }

    public function drawWinner()
    {
        $ticket = $this->availableTickets;
        if ($ticket->count() === 0) {
            throw new NotEnoughTicketsException;
            return;
        }
        $ticket = $ticket->first();
        $availableParticipants = $this->nonWinners;
        if ($availableParticipants->count() === 0) {
            throw new NotEnoughParticipantsException;
            return;
        }
        $winner = $availableParticipants->random(1)->first();
        $ticket->assignWinner($winner);
    }

    public function path($action = 'show')
    {
        return route("lottery.$action", $this);
    }
}
