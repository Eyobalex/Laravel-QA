<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use VotableTraits;
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

    //accessors
    public function getBodyHtmlAttribute(){
        return clean(\Parsedown::instance()->text($this->body));
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute(){
        return $this->id === $this->question->best_answer_id ? 'accepted' : '';
    }

    public function getIsBestAttribute(){
        return $this->id === $this->question->best_answer_id;
    }


}
