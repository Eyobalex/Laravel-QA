<?php
/**
 * Created by PhpStorm.
 * User: Eyob
 * Date: 7/19/2019
 * Time: 7:12 PM
 */?>


@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                        <div class="card-title">
                            <div class="d-flex align-items-center">
                                <h1>{{ $question->title }}</h1>
                                <div class="ml-auto">
                                    <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary" >Back</a>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="media">

                            <div class="d-flex flex-column vote-controls">
                                <a href="" title="This question is useful" class="vote-up" onclick="event.preventDefault(); document.getElementById('up-vote-question-{{$question->id}}').submit();">  <i class="fas fa-caret-up fa-3x"></i></a>
                                <span class="vote">{{ $question->votes_count }}</span>
                                <form action=" {{ route('voteQuestions', $question->id  ) }}" id="up-vote-question-{{$question->id}}" style="display: none;" method="post">
                                    @csrf
                                    <input type="hidden" name="vote" value="1">
                                </form>
                                <a href="" onclick="event.preventDefault(); document.getElementById('down-vote-question-{{$question->id}}').submit();" title="This question is not useful" class="vote-down"> <i class="fas fa-caret-down fa-3x"></i></a>
                                <form action="{{ route('voteQuestions', $question->id   ) }}" id="down-vote-question-{{$question->id}}" style="display: none;" method="post">
                                    @csrf
                                    <input type="hidden" name="vote" value="-1">
                                </form>
                                <a href="" title="Mark this question as favorite" class="favorite {{ $question->favorite_class }}  mt-2" onclick="event.preventDefault(); document.getElementById('favorite-question-{{$question->id}}').submit();">  <i class="fas fa-star fa-2x"></i>
                                    <span class="favorite-count">{{ $question->favoriteCount }}</span></a>

                                <form action=" {{ $question->id }}/favorite" id="favorite-question-{{$question->id}}" style="display: none;" method="post">
                                    @csrf
                                    @if ($question->is_favorite)
                                        @method ('delete')
                                    @endif
                                </form>
                            </div>
                            <div class="media-body">
                                {!! $question->body_html !!}

                                <div class="float-right">
                                    <span class="text-muted">Asked {{ $question->created_date }}</span>
                                    <div class="media">
                                        <a href="{{$question->user->url}}" class="pr-2">
                                            <img src="{{ $question->user->avatar }}" alt="">
                                        </a>
                                        <div class="media-body">
                                            <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include('partials.answers.index', ['answers_count' => $question->answers_count, 'answers' => $question->answers])


       @include('partials.answers.create')



    </div>

@endsection

