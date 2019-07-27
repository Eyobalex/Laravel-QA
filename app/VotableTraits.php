<?php
/**
 * Created by PhpStorm.
 * User: Eyob
 * Date: 7/27/2019
 * Time: 11:57 PM
 */

namespace App;

trait VotableTraits {
    public function votes(){
        return $this->morphToMany(User::class, 'votable');
    }
    public function upVotes(){
        return $this->votes()->wherePivot('vote',1);
    }
    public function downVotes(){
        return $this->votes()->wherePivot('vote',-1);
    }
}