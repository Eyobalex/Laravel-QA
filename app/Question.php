<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Question extends Model
{
    use VotableTraits;

    //fields
    protected $fillable = ['title', 'body',];



    //relationships
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function favorites(){
        return $this->belongsToMany(User::class, 'favorite')->withTimestamps();
    }

    //mutators
    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }



    //Accessors
    public function getUrlAttribute(){
        return route('questions.show', $this->slug);
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute(){
        if ($this->answers_count > 0){
            if ($this->best_answer_id){
                return "answered-accepted";
            }
            return "answered";
        }else{
            return "unanswered";
        }
    }
    public function getVotesCountAccessor(){
        return $this->votes->count();
    }

    public function getBodyHtmlAttribute(){
        return \Parsedown::instance()->text($this->body);
    }
    public function getIsFavoriteAttribute(){
        return $this->isFavorite();
    }
    public function getFavoriteClassAttribute(){
        return Auth::guest()? 'off' : ($this->isFavorite() ? 'favorited' : '');
    }
    public function getFavoriteCountAttribute(){
        return $this->favorites->count();
    }

    //
    public function acceptBestAnswer($answer){
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function isFavorite(){
        return $this->favorites()->where('user_id', auth()->id())->count() > 0;
    }
}
