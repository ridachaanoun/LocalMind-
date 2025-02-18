<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    
    protected $fillable = ['title', 'content', 'location', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

}
