<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = ['email'];

    public function ticket()
    {
        return $this->hasOne(Ticket::class);
    }

    public function path(Lottery $lottery, $string = 'show')
    {
        return route('participants.$string', ['lottery' => $lottery]);
    }
}
