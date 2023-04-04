<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Server extends Model
{
    use HasFactory;

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'serverId', 'id');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Votes::class, 'serverId', 'id');
    }
    public function getVotesCount(){
        $votes=0;
        foreach ($this->votes as $vote){
            $votes+=$vote->votes;
        }
        return $votes;
    }
}
