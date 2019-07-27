<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    //fields

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //

    //relationships

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function favorites(){
        return $this->belongsToMany(Question::class, 'favorite')->withTimestamps();
    }

    public function voteQuestions(){
        return $this->morphedByMany(Question::class, 'votable');
    }
    public function voteAnswers(){
        return $this->morphedByMany(Answer::class, 'votable');
    }
    //accessors

    public function getUrlAttribute(){
        return route('questions.show', $this->id);
    }

    public function getAvatarAttribute(){
        $email = $this->email;
        $size = 32;
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }

    //

    public function voteQuestion(Question $question, $vote){
        $voteQustions = $this->voteQuestions();
        if ($voteQustions->where('votable_id', $question->id)->exists()){
            $voteQustions->updateExistingPivot($question, ['vote'=>$vote]);
        }
        else{
            $voteQustions->attach($question, ['vote'=>$vote]);
        }
        $question->load('votes');
        $downVote = (int) $question->upVotes()->sum('vote');
        $upVote = (int) $question->downVotes()->sum('vote');
        $question->votes_count = $downVote + $upVote;
        $question->save();
    }

     
}
