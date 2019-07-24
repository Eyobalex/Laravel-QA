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
                            @include('partials.vote-control', ['type'=> 'question',
                             'like' => 'Mark this question as favorite',
                              'fa' => 'star',
                               'class'=>'favorite',
                               'action' => 'favorited'])
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

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h2>{{$question->answers_count ." " . str_plural('answer', $question->answers_count)}}</h2>
                        </div>
                        <hr>

                        @foreach($question->answers as $answer)
                            <div class="media">
                                @include('partials.vote-control', [
                                                                    'type'=> 'answer',
                                                                    'like' => 'Mark this answer as best answer',
                                                                    'fa' => 'check',
                                                                    'class'=>'answer',
                                                                    'action'=> ''])
                                <div class="media-body">
                                    {!! $answer->body_html !!}
                                    <div class="float-right">
                                        <span class="text-muted">Answered {{ $answer->created_date }}</span>
                                        <div class="media">
                                            <a href="{{$answer->user->url}}" class="pr-2">
                                                <img src="{{ $answer->user->avatar }}" alt="">
                                            </a>
                                            <div class="media-body">
                                                <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        </div>

@endsection

