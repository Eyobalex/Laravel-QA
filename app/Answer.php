<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //fields
    protected $fillable = ['body', 'user_id', 'question_id'];

    //constructors

    protected static function boot ()
    {
        parent::boot();
        static::created(function ($a){
            $a->question->increment('answers_count');
        });
        static::deleted(function ($a){
            $a->question->decrement('answers_count');
        });
    }

    //relationships

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    //mutators
    //accessors
    public function getBodyHtmlAttribute(){
        return \Parsedown::instance()->text($this->body);
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }
    //scope
}
