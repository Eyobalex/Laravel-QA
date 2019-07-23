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

                        @include('partials.message')

                       <div class="card-header">
                           <div class="d-flex align-items-center">
                               <h2>All Questions</h2>
                               <div class="ml-auto">
                                   <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary" >Ask question</a>
                               </div>
                           </div>

                       </div>
                        <div class="card-body">
                            @foreach($questions as $question)
                                <div class="media">
                                    <div class="d-flex flex-column counters">
                                        <div class="vote">
                                            <strong>{{ $question->votes }}</strong> {{ str_plural('vote', $question->votes) }}
                                        </div>
                                        <div class="status {{ $question->status }}">
                                            <strong>{{ $question->answers }}</strong> {{ str_plural('answer', $question->answers) }}
                                        </div>
                                        <div class="views">
                                            {{ $question->views .' '. str_plural('view', $question->views) }}
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <div class="d-flex align-items-center">
                                            <h3 class="mt-o"><a href="{{ $question->url }}">{{ $question->title}}</a></h3>
                                            {{--@if ( \Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->can('update-question', $question))--}}
                                            @can('update', $question)
                                                <a href="{{ route('questions.edit', $question->id) }}"class="btn btn-sm btn-outline-info ml-auto edit-btn"><span class="fa fa-edit">Edit</span></a>
                                            @endcan
                                       {{--@if ( \Illuminate\Support\Facades\Auth::check() && Auth::user()->can('delete-question', $question))--}}
                                            @can('delete', $question)

                                                <form action="{{ route('questions.destroy', $question->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"  class="btn btn-sm btn-outline-danger ml-auto" onclick="return confirm('I sincerely hope you know what your are doing!!!')">Delete</button>
                                                </form>
                                            @endcan

                                        </div>
                                        <p class="lead">
                                            Asked by : <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                            <small class="text-muted">{{$question->created_date}}</small>
                                        </p>

                                            {{ str_limit($question->body, 250) }}
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                            {{$questions->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

