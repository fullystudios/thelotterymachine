<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['participant_id'];

    public function winner()
    {
        return $this->belongsTo(Participant::class, 'participant_id');
    }

    public function assignWinner(Participant $participant)
    {
        return $this->update(['participant_id' => $participant->id]);
    }
}
