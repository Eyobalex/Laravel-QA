<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionController extends Controller
{
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
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param QuestionRequest $request
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $question->update($request->only('title', 'body'));
        return redirect()->route('questions.index')->with('success', 'You have successfully updated this question.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
