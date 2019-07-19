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
            <div class="col-md-8">
                <div class="card">

                       <div class="card-header">
                           All Questions
                       </div>
                        <div class="card-body">
                            @foreach($questions as $question)
                                <div class="media">
                                    <div class="media-body">
                                        <h3 class="mt-o">{{ $question->title}}</h3>
                                    {{--</div>--}}
                                    {{--<div class="media-body">--}}
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

