<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    //fields
    protected $fillable = ['title', 'body',];



    //relationships
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
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

    public function getBodyHtmlAttribute(){
        return \Parsedown::instance()->text($this->body);
    }


    //scope
    
}
