<?php
/**
 * Created by PhpStorm.
 * User: Eyob
 * Date: 7/24/2019
 * Time: 9:59 PM
 */?>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{$answers_count ." " . str_plural('answer', $answers_count)}}</h2>
                </div>
                <hr>
                @include('partials.message')
                @foreach($answers as $answer)
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
