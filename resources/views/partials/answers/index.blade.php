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
                        <div class="d-flex flex-column vote-controls">
                            <a href="" title="This answer is useful" class="vote-up">  <i class="fas fa-caret-up fa-3x"></i></a>
                            <span class="vote">123</span>
                            <a href="" title="This answer is not useful" class="vote-down off"> <i class="fas fa-caret-down fa-3x"></i></a>
                            @can('accept', $answer)
                                <a href="" title="Mark this answer as best answer" class="answer {{$answer->status}} mt-2" onclick="event.preventDefault(); document.getElementById('accept-answer-{{$answer->id}}').submit();">  <i class="fas fa-check fa-2x"></i>
                                    </a>
                                <form action="{{route('answers.accept', $answer->id)}}" id="accept-answer-{{$answer->id}}" style="display: none;" method="post">
                                    @csrf
                                </form>

                            @else
                                @if ($answer->is_best)
                                    <a href="" title="this is the  best answer" class="answer {{$answer->status}} mt-2" >  <i class="fas fa-check fa-2x"></i>
                                    </a>
                                @endif
                            @endcan
                        </div>


                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        @can('update', $answer)
                                            <a href="{{ route('questions.answers.edit',[$question->id, $answer->id]) }}"class="btn btn-sm btn-outline-info ml-auto edit-btn"><span>Edit</span></a>
                                        @endcan
                                        @can('delete', $answer)
                                            <form action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"  class="btn btn-sm btn-outline-danger ml-auto delete-btn" onclick="return confirm('I sincerely hope you know what your are doing!!!')">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
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
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
