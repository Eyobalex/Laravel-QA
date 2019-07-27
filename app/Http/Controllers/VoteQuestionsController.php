<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class VoteQuestionsController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth');
    }

    public function __invoke (Question $question)
    {
        $vote = \request()->vote;
        auth()->user()->voteQuestion($question, $vote);
        return back();
    }
}
