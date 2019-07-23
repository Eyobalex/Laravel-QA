<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Question;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionController extends Controller
{

    public function __construct ()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with('user')->latest()->paginate(5);

//        dd($questions->first());
        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Question();
        return view('questions.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QuestionRequest $request
     * @return Response
     */
    public function store(QuestionRequest $request)
    {
        $request->user()->questions()->create($request->only('title', 'body'));
        return redirect()->route('questions.index')->with('success', 'You have successfully asked a question.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question->increment('views');
        return view('questions.show', compact('question'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Question $question)
    {
//        if ( Gate::denies('update-question', $question)){
//            abort(401, "Access Denied");
//        }
        $this->authorize('update', $question);

        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param QuestionRequest $request
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(QuestionRequest $request, Question $question)
    {
//        if ( Gate::denies('update-question', $question)){
//            abort(401, "Access Denied");
//        }
        $this->authorize('update', $question);
        $question->update($request->only('title', 'body'));
        return redirect()->route('questions.index')->with('success', 'You have successfully updated this question.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Question $question)
    {
//        if ( Gate::denies('delete-question', $question)){
//            abort(401, "Access Denied");
//        }
        $this->authorize('delete', $question);
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'You have successfully deleted this question.');
    }
}
